<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Roles\GetRolesCollection;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GetRolesController extends Controller
{
    use JsonRespondController;

    /**
     * Handle the incoming request.
     *
     * @return GetRolesCollection|JsonResponse
     */
    public function __invoke(): JsonResponse|GetRolesCollection
    {
        try {
            $roles = Role::with('permissions')->get();

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond((new GetRolesCollection($roles)));
    }
}
