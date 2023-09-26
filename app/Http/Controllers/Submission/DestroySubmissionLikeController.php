<?php

namespace App\Http\Controllers\Submission;

use Illuminate\Http\Request;
use App\Models\SubmissionLike;
use App\Http\Controllers\Controller;

class DestroySubmissionLikeController extends Controller
{
    public function __invoke(SubmissionLike $submissionLike)
    {
        $submissionLike->delete();

        return redirect()->back();
    }
}
