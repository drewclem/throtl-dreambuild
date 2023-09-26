<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class CheckEmailController extends Controller
{
    public function __invoke(Request $request, Company $company)
    {
        try {
            $user = User::where('email', $request->email)->forCompany($company)->first();

            return response()->json([
                'exists' => $user ? true : false,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'exists' => false,
                'user' => null,
            ]);
        }
    }
}
