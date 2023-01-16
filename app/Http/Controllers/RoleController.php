<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use function response;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $roles = Role::orderBy('id', 'desc')->get();

        return response()->json($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }

    /**
     * Find resource by chosen field.
     *
     * @param string $by
     * @param string $value
     * @return JsonResponse
     */
    public function find(string $by, string $value): JsonResponse
    {
        $result = Role::where($by, '=', $value)->firstOrFail();

        return response()->json($result);
    }
}
