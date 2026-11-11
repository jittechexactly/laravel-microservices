<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class RegistrationEvent
{
    use Dispatchable;

    public function __construct(
        public string $token,
        public string $email,
    ) {}
}
