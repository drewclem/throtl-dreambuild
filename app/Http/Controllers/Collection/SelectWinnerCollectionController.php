<?php

namespace App\Http\Controllers\Collection;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectWinnerCollectionController extends Controller
{
    public function __invoke(Request $request, Collection $collection)
    {
        $collection->update([
            'winner_id' => $request->winner_id,
        ]);

        return redirect()->route('giveaways.edit', $collection)->with('success', 'Winner selected!');
    }
}
