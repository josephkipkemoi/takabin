<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function store(StoreUserRequest $request, Role $role)
    {       
        $user = User::create($request->validated());

        event(new Registered($user));

        Auth::login($user);
        
        $role = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $request->query('user_role')
        ]);

        return response()
                    ->json([
                        'user' => $user,
                        'role' => $role
                    ]);
    }

    public function login(AuthenticateRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->json([
            'user' => auth()->user()
        ]);
    }

    public function destroy()
    {
        Auth::guard('web')->logout();

        return response()->noContent();
    }
}
