<?php

namespace App\Http\Controllers\Submission;

use Inertia\Inertia;
use App\Models\Collection;
use App\Models\Submission;
use App\Http\Controllers\Controller;

class ShowSubmissionController extends Controller
{
    public function __invoke(Collection $collection, Submission $submission)
    {
        return Inertia::render('Giveaways/ShowSubmission', [
            'giveaway' => $collection,
            'submission' => $submission,
        ]);
    }
}
