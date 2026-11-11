<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\RegistrationRequest;
use App\Services\Auth\AuthenticationManagementService;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use DomainException;
use Symfony\Component\HttpFoundation\Response;

class AuthManagementController extends Controller
{
    use ResponseTrait;

    public function __construct(protected readonly AuthenticationManagementService $authService) {}

    public function register(RegistrationRequest $request)
    {
        try {
            $result = $this->authService->register($request);

            return $this->success(Response::HTTP_OK, 'OTP for registration sent.', $result, Carbon::now());
        } catch (DomainException $e) {
            return $this->error($e->getCode(), "Something went wrong!", Carbon::now());
        }
    }
}
