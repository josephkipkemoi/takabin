<?php

namespace App\CustomClass;

use App\Models\Balance;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistrationClass 
{
    public static function registerCollectee($request)
    {
        $phone_number = $request->validated()['phone_number'];
        $password = $request->validated()['password'];
        $role_id = $request->validated()['role_id'];

        $user = Role::find($role_id)->users()->create([
            'phone_number' => $phone_number,
            'password' => Hash::make($password)
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);

        return response()
                ->json([
                    'user' => $user,
                    'role' => $user->roles->first()->role
                 ]);   
    }

    public static function registerCollector($request)
    {
        $phone_number = $request->validated()['phone_number'];
        $password = $request->validated()['password'];
        $role_id = $request->validated()['role_id'];
        $service_id = $request->validated()['service_id'];

        $user = Role::find($role_id)->users()->create([
            'phone_number' => $phone_number,
            'service_id' => $service_id,
            'password' => Hash::make($password)
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
        
        return response()
                ->json([
                    'user' => $user,
                    'role' => $user->roles->first()->role
                 ]);   
    }
}