<?php

namespace App\Http\Controllers\Submission;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreSubmissionLikeController extends Controller
{
    public function __invoke(Request $request, Submission $submission)
    {
        $query = $request->query();

        DB::transaction(function () use ($request, $query, $submission) {
            $submission->likes()->create([
                'user_id' => $request->user()->id,
                'value' => $query['value'],
            ]);
        });
    }
}
