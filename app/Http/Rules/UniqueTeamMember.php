<?php

namespace App\Http\Rules;

use App\Models\Company;
use App\Models\CompanyTeamMember;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueTeamMember implements Rule
{
  public function __construct(protected ?Company $company = null, protected ?User $userToIgnore = null)
  {
  }

  public function passes($attribute, $value)
  {
    if (!$this->company || !$this->userToIgnore) {
      return true;
    }

    $user = User::whereEmail(strtolower($value))
      ->when($this->userToIgnore, function ($query) {
        $query->where('id', '!=', $this->userToIgnore->id);
      })
      ->first();

    if (!$user) {
      return true;
    }

    return match (true) {
      CompanyTeamMember::query()->forCompany($this->company)->forUser($user)->doesntExist() => true,
      default => false
    };
  }

  public function message()
  {
    return 'This user already exists on your team.';
  }
}
