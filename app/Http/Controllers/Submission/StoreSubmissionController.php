<?php

namespace App\Http\Controllers\Submission;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StoreSubmissionController extends Controller
{
    public function __invoke(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:submissions:id',
            'why' => 'required|max:100',
            'throtl_username' => 'required|max:255',
            'active_vip' => 'required|boolean',
            'vehicle_make' => 'required|max:255',
            'vehicle_model' => 'required|max:255',
            'vehicle_year' => 'required|integer',
            'car_info' => 'required',
            'dream_build' => 'required',
            'ig_post' => 'required',
            'fav_episode' => 'required',
            'social_media' => 'required',
            'terms_of_service' => 'required|boolean',
        ]);

        DB::transaction(function () use ($request) {
            Submission::create([
                'collection_id' => $request->collection_id,
                'name' => $request->name,
                'email' => $request->email,
                'why' => $request->why,
                'throtl_username' => $request->throtl_username,
                'active_vip' => $request->active_vip,
                'vehicle_make' => $request->vehicle_make,
                'vehicle_model' => $request->vehicle_model,
                'vehicle_year' => $request->vehicle_year,
                'car_info' => $request->car_info,
                'dream_build' => $request->dream_build,
                'ig_post' => $request->ig_post,
                'fav_episode' => $request->fav_episode,
                'social_media' => $request->social_media,
                'terms_of_service' => $request->terms_of_service,
            ]);

            return redirect()->back()->with('success', 'Submission created successfully.');
        });

        return redirect()->back()->with('error', 'Submission could not be created.');
    }
}
