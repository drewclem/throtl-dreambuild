<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyTeamMember;

class UpdateTeamMemberController extends Controller
{
    public function __invoke(Request $request, CompanyTeamMember $companyTeamMember)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', "unique:users,email,{$companyTeamMember->user->id},id"],
        ]);

        $companyTeamMember->user->update(
            $request->only('name', 'email')
        );

        return redirect()->back()->with('success', 'Team member updated.');
    }
}
