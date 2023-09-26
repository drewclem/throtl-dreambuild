<?php

namespace App\Http\Controllers\Submission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubmissionLike;

class UpdateSubmissionLikeController extends Controller
{
    public function __invoke(Request $request, SubmissionLike $submissionLike)
    {
        $query = $request->query();

        $submissionLike->update([
            'value' => $query['value'],
        ]);
    }
}
