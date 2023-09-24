<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Collection;

class DestroyCollectionController extends Controller
{
    public function __invoke(Collection $collection)
    {
        $collection->delete();

        return redirect()->route('giveaways');
    }
}
