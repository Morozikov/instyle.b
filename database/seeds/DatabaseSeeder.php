<?php

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
        // $this->call(UsersTableSeeder::class);
        // Create 10 records of customers
        factory(App\User::class, 10)->create()->each(function ($user) {
            // Seed the relation with one address
            $userData = factory(App\UserData::class)->make();
            $user->userData()->save($userData);

        });
    }
}
