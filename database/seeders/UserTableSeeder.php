<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'password123';

        User::factory()->create([
            'username' => 'super',
            'fullname' => 'Super Admin',
            'password' => bcrypt($password),
        ]);

        User::factory(10)->create([
            'password' => bcrypt($password),
        ]);
    }
}
