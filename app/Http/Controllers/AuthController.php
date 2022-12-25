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
    //
    public function store(StoreUserRequest $request)
    {  
        RegistrationClass::registerCollectee($request);
    }

    public function store_collector(StoreCollectorUserRequest $collector_request)
    {
        RegistrationClass::registerCollector($collector_request);
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
        Auth::guard('api')->logout();

        return response()->noContent();
    }
}
