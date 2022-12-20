<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    //
    public function store(StoreCollectionRequest $request, Collection $collection)
    {
        return $collection->create($request->validated());
    }

    public function index()
    {
        $collections = Collection::where('collected', false);

        return  response()
                    ->json([
                        'collections' => $collections->get(),
                        'collections_count' => $collections->count()
                    ]);
    }
}
