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

        $now = now();
        $items = [];

        foreach ($user_id as $sender) {
            foreach ($user_id as $receiver) {
                if ($sender == $receiver) {
                    continue;
                }

                $items[] = [
                    'item_id'       => 1,
                    'sender_id'     => $sender,
                    'receiver_id'   => $receiver,
                    'message'       => "Test Message ({$sender} -> {$receiver})",
                    'created_at'    => $now,
                ];
            }
        }
        DB::table('chats')->insert($items);
    }
}
