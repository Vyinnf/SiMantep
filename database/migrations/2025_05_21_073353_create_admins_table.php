<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Tambahkan ini
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert admin setelah tabel dibuat
        // Admin::create([
        //     'name' => 'Arif',
        //     'email' => 'admin@simantep.id',
        //     'password' => Hash::make('admin123'),
        // ]);
        // Admin::create([
        //     'name' => 'Abdi',
        //     'email' => 'abdi@simantep.id',
        //     'password' => Hash::make('admin123'),
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
