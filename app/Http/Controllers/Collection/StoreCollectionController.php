<?php

namespace App\Http\Controllers\Collection;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreCollectionController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            Collection::create([
                'name' => $request->name,
                'open_date' => $request->start,
                'close_date' => $request->end,
                'company_id' => $request->user()->company->id,
            ]);
        });
    }
}
