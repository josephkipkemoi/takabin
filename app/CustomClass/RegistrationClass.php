<?php

namespace App\CustomClass;

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

        $user = User::create([
            'phone_number' => $phone_number,
            'password' => Hash::make($password)
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
            
        $role = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role_id 
        ]);
            
        return response()
                ->json([
                    'user' => $user,
                    'role' => Role::find($role->role_id)->role
                 ]);   
    }

    public static function registerCollector($request)
    {
        $phone_number = $request->validated()['phone_number'];
        $password = $request->validated()['password'];
        $role_id = $request->validated()['role_id'];
        $service_id = $request->validated()['service_id'];

        $user = User::create([
            'phone_number' => $phone_number,
            'password' => Hash::make($password),
            'service_id' => $service_id
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
            
        $role = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role_id 
        ]);
            
        return response()
                ->json([
                    'user' => $user,
                    'role' => Role::find($role->role_id)->role
                 ]);   
    }
}