<?php

namespace App\Http\Rules;

use Illuminatech\Validation\Composite\CompositeRule;

class ValidEmail extends CompositeRule
{
  protected function rules(): array
  {
    return ['email:rfc,spoof,filter'];
  }

  protected function messages(): array
  {
    return [
      'email' => ':input is an invalid email address.',
    ];
  }
}
