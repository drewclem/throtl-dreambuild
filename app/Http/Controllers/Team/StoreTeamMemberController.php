<?php

namespace App\Http\Controllers\Team;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CompanyTeamMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamMemberRequest;

class StoreTeamMemberController extends Controller
{
    public function __invoke(StoreTeamMemberRequest $request)
    {
        $companyTeamMember = $this->createCompanyTeamMember($request);

        return redirect()->back()->with('success', 'Team member added.');
    }

    private function createCompanyTeamMember(Request $request, bool $withTrashed = false): CompanyTeamMember
    {
        return DB::transaction(function () use ($request, $withTrashed) {
            $company = $request->user()->company;

            $user = User::query()
                ->where('email', $request->email)
                ->withTrashed()
                ->firstOr(function () use ($request, $company) {
                    return User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt('password'),
                        'company_id' => $company->id
                    ]);
                });

            if ($user->trashed()) $user->restore();

            return CompanyTeamMember::withTrashed($withTrashed)->firstOrCreate([
                'company_id' => $company->id,
                'user_id' => $user->id,
                'role' => 'member',
            ]);
        });
    }
}
