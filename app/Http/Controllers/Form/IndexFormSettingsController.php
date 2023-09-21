<?php

namespace App\Http\Controllers\Form;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexFormSettingsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('FormSettings');
    }
}
