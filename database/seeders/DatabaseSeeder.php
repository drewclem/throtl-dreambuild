<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Core\Number;
use App\Models\Company;
use App\Models\Submission;
use App\Models\Collection;
use Illuminate\Database\Seeder;
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
        ]);

        $company = Company::factory()->create([
            'user_id' => $user->id,
            'name' => "Racer's Edge",
        ]);

        $number = new Number();

        $collection = Collection::factory()->create([
            'company_id' => $company->id,
            'name' => "Racer's Edge Giveaway" . $number->randomNumber(2, true),
            'cta' => 'Enter Now',
            'subtitle' => 'Enter to win a free car',
            'lowerBanner' => 'Enter to win a free car',
        ]);

        Submission::factory()->count(25)->create([
            'collection_id' => $collection->id,
        ]);
    }
}
