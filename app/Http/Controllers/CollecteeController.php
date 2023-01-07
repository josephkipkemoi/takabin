<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Service;
use Illuminate\Http\Request;

class CollecteeController extends Controller
{
    //
    public function index(Request $request, Collection $collection)
    {

        // 'collected', $request->query('collected')
        $collections = $collection
                            ->where([
                                ['user_id', '=',$request->user_id],
                                ['collected', '=', $request->query('collected')]

                                ])
                            // ->where(function ($query) {
                            //     $query->where('collected', $request->query('collected'));
                            // })
                            ->orderBy('created_at', 'desc')
                            ->paginate(10) ;

        return $collections;
    }
}
