<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'masteradmin',
            'email' => 'admin@pialegong.com',
            'email_verified_at' => date('2023-01-01'),
            'password' => bcrypt('pialegong2023'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Kasir 1',
            'username' => 'kasir1',
            'email' => 'kasir@pialegong.com',
            'email_verified_at' => date('2023-01-01'),
            'password' => bcrypt('pialegong2023'),
        ]);

        $user->assignRole('kasir');
        $user = User::create([
            'name' => 'Kasir 2',
            'username' => 'kasir2',
            'email' => 'kasir@pialegong.com',
            'email_verified_at' => date('2023-01-01'),
            'password' => bcrypt('pialegong2023'),
        ]);

        $user->assignRole('kasir');
        $user = User::create([
            'name' => 'Kasir 3',
            'username' => 'kasir3',
            'email' => 'kasir@pialegong.com',
            'email_verified_at' => date('2023-01-01'),
            'password' => bcrypt('pialegong2023'),
        ]);

        $user->assignRole('kasir');
        $user = User::create([
            'name' => 'Kasir 4',
            'username' => 'kasir4',
            'email' => 'kasir@pialegong.com',
            'email_verified_at' => date('2023-01-01'),
            'password' => bcrypt('pialegong2023'),
        ]);

        $user->assignRole('kasir');
        $user = User::create([
            'name' => 'Kasir 5',
            'username' => 'kasir5',
            'email' => 'kasir@pialegong.com',
            'email_verified_at' => date('2023-01-01'),
            'password' => bcrypt('pialegong2023'),
        ]);

        $user->assignRole('kasir');
    }
}
