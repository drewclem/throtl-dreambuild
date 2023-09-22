<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function randomUser($states = [], $overrides = []): User
    {
        $userFactory = User::factory();

        foreach ($states as $state) {
            $userFactory->state($state);
        }

        return $userFactory->create($overrides);
    }
}
