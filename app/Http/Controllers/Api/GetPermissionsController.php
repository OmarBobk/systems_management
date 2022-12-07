<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permissions\GetPermissionsCollection;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class GetPermissionsController extends Controller
{
    use JsonRespondController;

    /**
     * Handle the incoming request.
     *
     * @return GetPermissionsCollection|JsonResponse
     */
    public function __invoke(): GetPermissionsCollection|JsonResponse
    {
        try {
            $permissions = Permission::with('roles')->get();

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond((new GetPermissionsCollection($permissions)));
    }
}
