<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('phone');
            $table->timestamps();
        });

        $data = [
            [
                'id' => 1,
                'name' => 'Doniyorbek',
                'login' => 'admin',
                'password' => '$2y$10$JYAvNs8XEqlVYQIoVEekYe/qOdpDvX40JTOuJ8htPfdV0UQVvplsm',
                'phone' => "+998-99-789-80-69"
            ]
        ];
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
