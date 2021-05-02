<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            'name' => 'Company',
            'email' => 'company@company.com',
            'password' => bcrypt('company')
        );
        User::create($user);
        // \App\Models\User::factory(10)->create();
    }
}
