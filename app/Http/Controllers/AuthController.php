<?php

namespace App\Http\Controllers;

use App\CustomClass\RegistrationClass;
use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\StoreCollectorUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store', 'store_collector', 'login']]);
    }
    //
    public function store(StoreUserRequest $request)
    {  
       return RegistrationClass::registerCollectee($request);
    }

    public function store_collector(StoreCollectorUserRequest $collector_request)
    {
       return RegistrationClass::registerCollector($collector_request);
    }
    
    public function login(AuthenticateRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $token = Auth::attempt($request->validated());

        if(!$token) {
            return response()
                    ->json([
                        'status' => 'error',
                        'message' => 'unauthorized'
                    ], 401);
        }
        
        $user = auth()->user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'role' => $user->roles()->first()->role,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ]);
    }

    public function destroy()
    {
        Auth::logout();

        return response()->noContent();
    }
}
