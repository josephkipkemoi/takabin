<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class CollectorController extends Controller
{
    //
    public function index()
    {
        $roleId = Role::where('role', 'collector')->first()->id;

        $collectors = Role::find($roleId)->users()->paginate(10);
    
        return $collectors;
    }
}
