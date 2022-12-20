<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;

class AddressController extends Controller
{
    //
    public function store(StoreAddressRequest $request, Address $address)
    {
        return $address->create($request->validated());
    }
}
