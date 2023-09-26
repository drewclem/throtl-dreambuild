<?php

namespace App\Http\Controllers\Team;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyTeamMemberResource;

class IndexTeamController extends Controller
{
    public function __invoke(Request $request)
    {
        $members = $request->user()->companyMember->company->members;

        return Inertia::render('Team/Team', [
            'teamMembers' => CompanyTeamMemberResource::collection($members)
        ]);
    }
}
