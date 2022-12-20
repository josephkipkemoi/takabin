<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        Auth::login($user);

        return $user;
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
