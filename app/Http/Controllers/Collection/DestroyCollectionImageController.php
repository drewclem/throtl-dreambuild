<?php

namespace App\Http\Controllers\Collection;

use App\Models\Collection;
use App\Http\Controllers\Controller;

class DestroyCollectionImageController extends Controller
{
    public function __invoke(Collection $collection)
    {
        $collection->update([
            'image_url' => null
        ]);

        return redirect()->back()->with('success', 'Collection image removed.');
    }
}
