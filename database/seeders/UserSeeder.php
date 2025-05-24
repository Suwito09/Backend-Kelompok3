<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = ['A', 'B', 'C'];

        $now   = now();
        $items = [];

        foreach ($users as $user) {
            $items[] = [
                'name'       => "User Test {$user}",
                'email'      => "usertest{$user}@email.com",
                'password'   => bcrypt('usertest123'),
                'role'       => 'user',
                'created_at' => $now,
            ];
        }

        $items[] = [
            'name'       => 'Admin',
            'email'      => 'admin@example.com',
            'password'   => bcrypt('admintest123'),
            'role'       => 'admin',
            'created_at' => $now,
        ];

        DB::table('users')->insert($items);
    }
}
