<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Core\Number;
use App\Models\Company;
use App\Models\Collection;
use App\Models\Submission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\CompanyTeamMember;
use Illuminate\Foundation\Testing\WithFaker;

class DatabaseSeeder extends Seeder
{
    use WithFaker;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => "Brian O'Connor",
            'email' => 'brian@lapd.com',
            'password' => bcrypt('buster'),
            'activation_stage' => 'active'
        ]);

        $company = Company::factory()->create([
            'user_id' => $user->id,
            'name' => "Racer's Edge",
        ]);

        CompanyTeamMember::factory()->create([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'role' => 'owner',
        ]);

        $number = new Number();

        $collectionName = "Racer's Edge Giveaway" . $number->randomNumber(2, true);
        $slug = Str::of($collectionName)->slug('-');

        $collection = Collection::factory()->create([
            'company_id' => $company->id,
            'name' => "Racer's Edge Giveaway" . $number->randomNumber(2, true),
            'cta' => 'Enter Now',
            'subtitle' => 'Enter to win a free car',
            'lowerBanner' => 'Enter to win a free car',
            'open_date' => now()->subDays(3),
            'close_date' => now()->addDays(10),
            'slug' => $slug,
        ]);

        Submission::factory()->count(25)->create([
            'collection_id' => $collection->id,
        ]);
    }
}
