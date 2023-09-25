<?php

namespace App\Http\Rules;

use App\Models\User;
use App\Models\Company;
use App\Http\Rules\Lowercase;
use App\Http\Rules\ValidEmail;
use Illuminatech\Validation\Composite\CompositeRule;

class UniqueTeamMemberEmail extends CompositeRule
{
  public function __construct(protected ?Company $company = null, protected ?User $userToIgnore = null)
  {
  }

  protected function rules(): array
  {
    return [new ValidEmail(), new Lowercase(), new UniqueTeamMember($this->company, $this->userToIgnore)];
  }
}
