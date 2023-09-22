<?php

namespace App\Http\Controllers\Collection;

use Inertia\Inertia;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubmissionResource;

class EditCollectionController extends Controller
{
    public function __invoke(Collection $collection)
    {
        $submissions = SubmissionResource::collection($collection->submissions);

        return Inertia::render('Giveaways/EditGiveaway', [
            'giveaway' => $collection,
            'submissions' => $submissions,
        ]);
    }
}
