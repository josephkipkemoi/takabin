<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Models\Address;
use App\Models\Collection;
use App\Models\User;

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
        $users_to_collect = User::whereIn('id', $collections->get('user_id'));

        return  response()
                    ->json([
                        'collections' => [
                         'data' => [
                             'users' => $users_to_collect->get(),
                            ],
                        ],
                        'collections_count' => $users_to_collect->count()
                    ]);
    }
}
