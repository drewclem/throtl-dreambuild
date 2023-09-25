<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Team
{
  public function teamMembers(): HasMany;
}
