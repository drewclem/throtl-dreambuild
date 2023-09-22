<?php

namespace App\Http\Controllers\Collection;

use Inertia\Inertia;
use App\Models\Collection;
use App\Http\Controllers\Controller;

class ShowCollectionController extends Controller
{
    public function __invoke(Collection $collection)
    {
        return Inertia::render('Giveaways/ShowGiveaway', [
            'giveaway' => $collection
        ]);
    }
}
