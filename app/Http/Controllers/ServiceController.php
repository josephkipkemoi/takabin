<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    //
    public function index()
    {
        return Service::get(['id', 'service', 'service_description', 'service_img_url']);
    }

    public function store(ServiceRequest $request,Service $service)
    {
        return $service->create($request->validated());
    }

    public function destroy($service_id, Service $service)
    {
        return $service->find($service_id)->delete();
    }
}
