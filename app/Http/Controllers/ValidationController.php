<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    //
    public function validated(Request $request)
    {
        if($request->query('type') == 'user') {
           $user = User::where('phone_number',$request->query('phone_number'))->get()->count();

           if($user > 0) {
            return response()
                    ->json([
                        'user' => $user
                    ]);
           }

           return response()
           ->json([
               'user' => $user
           ]);
        };

        if($request->query('type') == 'address') {
            $user = User::where('phone_number',$request->query('phone_number'))->first()->address;
 
            if($user == null) {
                return response()
                ->json([
                    'address_updated' => 0
                ]);
            }

            return response()
            ->json([
                'address_updated' => 1
            ]);

        };
    }
}
