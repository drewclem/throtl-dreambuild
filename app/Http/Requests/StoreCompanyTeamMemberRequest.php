<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Contracts\Team;
use App\Http\Rules\UniqueTeamMemberEmail;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyTeamMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Team $team = null, User $userToIgnore = null): array
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', new UniqueTeamMemberEmail($team, $userToIgnore)]
        ];
    }
}
