<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['pending', 'approved', 'rejected'];

        $now = now();
        $items = [];

        foreach ($statuses as $status) {
            $items[] = [
                'item_id'       => 1,
                'user_id'       => 1,
                'full_name'     => "Test Return ({$status})",
                'student_number'=> "1234567890",
                'proof'         => "Test Proof ({$status})",
                'status'        => $status,
                'created_at'    => $now,
            ];
        }
        DB::table('returns')->insert($items);
    }
}
