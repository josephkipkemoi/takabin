<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollecteeController extends Controller
{
    //
    public function pending(Request $request, Collection $collection)
    {
        return $collection
                    ->where('user_id', $request->user_id)
                    ->where('collected', false)
                    ->get();
    }
}
