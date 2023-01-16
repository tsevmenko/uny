<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use function response;

class RoleAdminController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $this->authorize('role_create');

        $request->validated();

        $roleId = Role::create($request->post());

        return response()->json($roleId);
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
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $this->authorize('role_edit');

        $request->validated();

        $updatedRole = $role->fill($request->post())->save();

        return response()->json($updatedRole);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->authorize('role_delete');

        $result = $role->delete();

        return response()->json($result);
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
