<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Support\Roles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request): Response
    {
        $this->authorize('role_create');

        $data = $request->validated();

        $role = Role::firstOrCreate(['name' => 'User']);

        $data = array_merge($data, [
            'password' => Hash::make($data['password']),
            'password_confirmation' => Hash::make($data['password_confirmation']),
            'role_id' => $role->id
        ]);

        $newUser = User::firstOrCreate([
            'email' => $data['email'],
        ], $data);

        return response($newUser);
    }
}
