<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            LocationSeeder::class,
            OptionValueSeeder::class,
        ]);
        \App\Models\Estate::factory()->count(100)->create();

        \App\Models\UserAgent::factory()->count(20)->create();
        \App\Models\Visitor::factory()->count(100)->create();
    }
}
