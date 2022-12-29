<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Models\Address;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    //
    public function store(StoreCollectionRequest $request, Collection $collection)
    {
        return $collection->create($request->validated());
    }

    public function index(Request $request)
    {
        $collections = Collection::where('collected', false)
                                   ->where('service_id', $request->query('service_id'));
                                          
        return  response()
                    ->json([
                        'collections' => $collections->get(),
                        'collections_count' =>  $collections->get()->count()
                    ]);
    }
}
