<?php

namespace App\Http\Controllers\Collection;

use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreCollectionController extends Controller
{
    public function __invoke(Request $request)
    {
        $slugifiedName = Str::of($request->name)->slug('-') . '-' . Str::random(3);

        $request->validate([
            'name' => 'required|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $slugifiedName) {
            Collection::create([
                'name' => $request->name,
                'open_date' => $request->start,
                'close_date' => $request->end,
                'slug' => $slugifiedName,
                'company_id' => $request->user()->company->id,
            ]);
        });
    }
}
