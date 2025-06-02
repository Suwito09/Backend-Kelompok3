<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'created_at'
            ]);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
                'updated_at'
            ]);
        });

        Schema::table('returns', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
                'updated_at'
            ]);
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('returns', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
                'updated_at'
            ]);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
                'updated_at'
            ]);
        });

        Schema::table('returns', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
                'updated_at'
            ]);
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn([
                'created_at',
                'updated_at'
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->datetime('created_at');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });

        Schema::table('returns', function (Blueprint $table) {
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->datetime('created_at');
        });
    }
};
