<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCollectionCollectorFields;
use App\Http\Requests\UpdatePickedCollectionRequest;
use App\Models\Collection;
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

    public function patch(UpdateCollectionCollectorFields $request, Collection $collection)
    {
        return $collection->where('user_id',$request->user_id)->update($request->validated());
    }

    public function picked(UpdatePickedCollectionRequest $request, Collection $collection)
    {
        $collection = $collection->find($request->collection_id);
        
        $collection->update($request->validated());

        return $collection;
    }
}
