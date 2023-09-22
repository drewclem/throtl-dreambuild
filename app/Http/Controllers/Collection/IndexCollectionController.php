<?php

namespace App\Http\Controllers\Collection;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionResource;

class IndexCollectionController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return Inertia::render('Dashboard', [
            'giveaways' => CollectionResource::collection($user->company->collections),
        ]);
    }
}
