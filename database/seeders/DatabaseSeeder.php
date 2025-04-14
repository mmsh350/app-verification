<?php

namespace Database\Seeders;

use App\Models\ClaimCount;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(1)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Create one record
        SiteSetting::factory(1)->create();

        foreach (Service::factory()->withCustomData() as $data) {
            Service::create($data);
        }

        ClaimCount::factory(1)->create();

         $this->call([
                ReferralBonusTableSeeder::class,
           ]);
    }
}
