<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchUserBalanceRequest;
use App\Models\User;

class BalanceController extends Controller
{
    //
    public function show($user_id)
    {
        return User::find($user_id)->balance;
    }

    public function patch($user_id, PatchUserBalanceRequest $request)
    {
        return User::find($user_id)->balance()->update($request->validated());
    }
}
