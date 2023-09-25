<?php

namespace App\Http\Controllers\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyTeamMemberResource;
use App\Models\CompanyTeamMember;
use Inertia\Inertia;

class EditTeamMemberController extends Controller
{
    public function __invoke(Request $request, CompanyTeamMember $companyTeamMember)
    {
        return Inertia::render('Team/EditTeamMember', [
            'member' => CompanyTeamMemberResource::make($companyTeamMember),
        ]);
    }
}
