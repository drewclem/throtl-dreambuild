<?php

namespace Tests\Feature\Collection;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IndexCollectionControllerTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;
    private Company $company;

    protected function setup(): void
    {
        parent::setup();
        $this->user = $this->randomUser();
        $this->company = Company::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }


    /** @test */
    public function itReturnsCollections(): void
    {
        Collection::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);

        $this->actingAs($this->user)->get('/giveaways')->assertInertia(
            fn ($assert) => $assert
                ->component('Dashboard')
                ->has('giveaways', 3)
        );
    }
}
