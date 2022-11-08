<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetuserController extends Controller
{
    use JsonRespondController;

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $user = Auth::user()->load(['roles']);

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond(
            data: [
                'token' => $request->bearerToken(),
                'data'  => (new UserResource($user)),
            ]
        );
    }
}
