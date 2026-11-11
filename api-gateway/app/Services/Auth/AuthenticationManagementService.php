<?php

namespace App\Services\Auth;

use App\Services\Common\ProxyServerConnectionManagementService;
use App\Traits\ExceptionTrait;
use App\Traits\ResponseTrait;
use DomainException;

class AuthenticationManagementService extends ProxyServerConnectionManagementService
{
    use ExceptionTrait, ResponseTrait;

    protected function service(): string
    {
        return 'identity';
    }

    public function register(string $email)
    {
        try {
            return $this->send($this->http()->post('/register', $email));
        } catch (DomainException $th) {
            $this->logError($th->getMessage(), $th);
            throw $th;
        }
    }
}
