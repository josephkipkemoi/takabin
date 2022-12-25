<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function store(StoreUserRequest $request, Role $role)
    {       
        $phone_number = $request->validated()['phone_number'];
        $password = $request->validated()['password'];

        $user = User::create([
            'phone_number' => $phone_number,
            'password' => Hash::make($password)
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        $role = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $request->query('user_role')
        ]);

        return response()
                    ->json([
                        'user' => $user,
                        'role' => Role::find($role->role_id)->role
                    ]);
    }

    public function login(AuthenticateRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->json([
            'user' => auth()->user(),
            'role' => auth()->user()->roles()->first()->role
        ]);
    }

    public function destroy()
    {
        Auth::guard('web')->logout();

        return response()->noContent();
    }
}
