<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function store(StoreAddressRequest $request, Address $address)
    {
        return $address->create($request->validated());
    }

    public function show(Request $request)
    {
        return Address::where('user_id', $request->user_id)->first();
    }
}
