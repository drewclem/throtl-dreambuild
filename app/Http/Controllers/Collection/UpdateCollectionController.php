<?php

namespace App\Http\Controllers\Collection;

use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UpdateCollectionController extends Controller
{
    public function __invoke(Request $request, Collection $collection)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start' => 'nullable|date',
            'end' => 'nullable|date',
            'cta' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'lowerBanner' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:collections,slug,' . $collection->id,
            'color' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $collection) {
            $collection->update([
                'name' => $request->name,
                'open_date' => $request->start,
                'close_date' => $request->end,
                'cta' => $request->cta,
                'subtitle' => $request->subtitle,
                'lowerBanner' => $request->lowerBanner,
                'color' => $request->color,
            ]);

            if ($request->hasFile('file')) {
                $imagePath = $request->file('file')[0]->storeAs(
                    'images',
                    'img-' . Str::random(8) . '.' . $request->file('file')[0]->getClientOriginalExtension(),
                    'public'
                );

                $collection->update([
                    'image_url' => '/' . $imagePath
                ]);
            }
        });


        return redirect()->route('giveaways.edit', $collection)->with('success', 'Collection updated.');
    }
}
