<?php

namespace App\Http\Controllers\Company;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexCompanySettingsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('CompanySettings');
    }
}
