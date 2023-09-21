<?php

namespace App\Http\Controllers\Team;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexTeamController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Team');
    }
}
