<?php

namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class HealthController extends Controller
{

    public function __invoke()
    {
        $appName = app('app.name');

        return $this->success(
            Response::HTTP_OK,
            "{$appName} running successfully.",
            null,
            now()
        );
    }
}