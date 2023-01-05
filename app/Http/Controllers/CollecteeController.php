<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Service;
use Illuminate\Http\Request;

class CollecteeController extends Controller
{
    //
    public function pending(Request $request, Collection $collection)
    {
        $collections = $collection
                            ->where('user_id', $request->user_id)
                            ->where('collected', $request->query('collected'))
                            ->orderBy('created_at', 'desc') ;

        return $collections->get();
    }
}
