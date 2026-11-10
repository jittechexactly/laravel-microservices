<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function test_health_route_returns_ok(): void
    {
        $response = $this->getJson('/api/v1/common/health');

        $response->assertOk()
            ->assertJson([
                'success'    => true,
                'statusCode' => 200,
                'message'    => app('app.name') . ' running successfully.',
                'errors'     => null,
                'data'       => null,
            ])
            ->assertJsonStructure([
                'success',
                'statusCode',
                'message',
                'errors',
                'data',
                'timeInfo',
            ]);
    }

    public function test_health_route_uses_singleton_app_name(): void
    {
        config(['app.name' => 'identity-service']);

        $this->assertSame(config('app.name'), app('app.name'));
    }

    public function test_health_route_does_not_require_authentication(): void
    {
        $this->getJson('/api/v1/common/health')->assertStatus(200);
    }
}
