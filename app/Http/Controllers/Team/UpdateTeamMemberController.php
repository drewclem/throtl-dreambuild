<?php

namespace App\Http\Controllers\Team;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanyTeamMember;
use App\Http\Controllers\Controller;

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

        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->storeAs(
                'avatars',
                'img-' . Str::random(8) . '.' . $request->file('avatar')->getClientOriginalExtension(),
                'public'
            );

            $companyTeamMember->user->update([
                'avatar' => '/' . $imagePath,
            ]);
        }

        return redirect()->back()->with('success', 'Team member updated.');
    }
}
