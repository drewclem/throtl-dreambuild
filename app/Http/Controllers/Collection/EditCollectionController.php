<?php

namespace App\Http\Controllers\Collection;

use Inertia\Inertia;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditCollectionController extends Controller
{
    public function __invoke(Collection $collection)
    {
        return Inertia::render('Giveaways/EditGiveaway', [
            'giveaway' => $collection,
        ]);
    }
}
