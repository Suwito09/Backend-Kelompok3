<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_id = [1, 2, 3];

        $items = [];

        foreach ($user_id as $sender) {

                $items[] = [
                    'item_id'       => 1,
                    'user_id'       => $sender,
                    'message'       => "Test Message ({$sender})",
                ];
        }
        DB::table('chats')->insert($items);
    }
}
