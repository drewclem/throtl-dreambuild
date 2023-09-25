<?php

namespace App\Http\Controllers\Team;

use Illuminate\Http\Request;
use App\Models\CompanyTeamMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DestroyTeamMemberController extends Controller
{
    public function __invoke(CompanyTeamMember $companyTeamMember)
    {
        DB::transaction(function () use ($companyTeamMember) {
            $companyTeamMember->delete();
            $companyTeamMember->user->delete();
        });

        return redirect()->back();
    }
}
