<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use JsonRespondController;

    /**
     * @return JsonResponse
     */
    public function success(): JsonResponse
    {
        return $this->respond([
            'success' => [
                'message' => 'Welcome to Talebetti',
            ],
            'links' => [
                'login_url' => route('api.v1.auth.login'),
                'logout_url' => route('api.v1.auth.logout'),
                'register_url' => route('api.v1.auth.register'),
                'verify_email_url' => route('api.v1.auth.verify-email'),
                'homepage_url' => route('api.v1.homepage'),
            ],
        ]);
    }
}
