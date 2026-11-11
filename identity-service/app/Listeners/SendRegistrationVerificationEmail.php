<?php

namespace App\Listeners;

use App\Events\RegistrationEvent;
use App\Mail\VerifyRegistrationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendRegistrationVerificationEmail implements ShouldQueue
{
    public int $tries = 3;
    public int $backoff = 30;

    public function handle(RegistrationEvent $event): void
    {
        $url = URL::temporarySignedRoute(
            config('identity.services.apigateway') . "/api/v1/auth/email-verify",
            now()->addMinutes(60),
            ['token' => $event->token]
        );

        Mail::to($event->email)->send(new VerifyRegistrationMail($url));
    }

    public function failed(RegistrationEvent $event, \Throwable $e): void
    {
        logger()->error('Registration verification email failed', [
            'email' => $event->email,
            'error' => $e->getMessage(),
        ]);
    }
}
