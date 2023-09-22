<?php

namespace App\Http\Controllers\Submission;

use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubmissionRequest;

class StoreSubmissionController extends Controller
{
    public function __invoke(StoreSubmissionRequest $request)
    {
        DB::transaction(function () use ($request) {
            Submission::create([
                'collection_id' => $request->input('collection_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'why' => $request->input('why'),
                'throtl_username' => $request->input('throtl_username'),
                'active_vip' => $request->input('active_vip'),
                'vehicle_make' => $request->input('vehicle_make'),
                'vehicle_model' => $request->input('vehicle_model'),
                'vehicle_year' => $request->input('vehicle_year'),
                'car_info' => $request->input('car_info'),
                'dream_build' => $request->input('dream_build'),
                'ig_post' => $request->input('ig_post'),
                'fav_episode' => $request->input('fav_episode'),
                'social_media' => $request->input('social_media'),
                'terms_of_service' => $request->input('terms_of_service'),
            ]);

            return redirect()->back()->with('success', 'Submission created successfully.');
        });

        return redirect()->back()->with('error', 'Submission could not be created.');
    }
}
