<?php

namespace Database\Seeders;

use App\Models\ClaimCount;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        SiteSetting::truncate();
        Service::truncate();
        ClaimCount::truncate();


       User::updateOrCreate(
        ['email' => 'admin@usseytech.com.ng'],
        [
            'name' => 'Ussey Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('@Ussey1058'),
            'remember_token' => Str::random(10),
        ]
       );

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
