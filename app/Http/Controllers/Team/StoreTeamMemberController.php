<?php

namespace App\Http\Controllers\Team;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyTeamMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreTeamMemberController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $company = $request->user()->company;

        DB::transaction(function () use ($request, $company) {
            $user = User::query()
                ->forCompany($company)
                ->whereEmail($request->email)
                ->firstOr(function () use ($request) {
                    return User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt('password'),
                        'activation_stage' => 'invited',
                    ]);
                });

            CompanyTeamMember::firstOrCreate([
                'company_id' => $company->id,
                'user_id' => $user->id,
                'role' => 'member',
            ]);
        });

        return redirect()->back()->with('success', 'Team member added.');
    }
}
