<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['lost', 'found'];
        $statuses = ['pending', 'returned', 'resolved'];

        $now = now();
        $items = [];

        foreach ($types as $type) {
            foreach ($statuses as $status) {
                $items[] = [
                    'user_id'    => 1,
                    'name'       => "Test Item ({$type}, {$status})",
                    'description'=> "Test Description ({$type}, {$status})",
                    'location'   => "Test Location ({$type}, {$status})",
                    'image'      => "Test Image ({$type}, {$status})",
                    'type'       => $type,
                    'status'     => $status,
                    'created_at' => $now,
                ];
            }
        }
        DB::table('items')->insert($items);
    }
}
