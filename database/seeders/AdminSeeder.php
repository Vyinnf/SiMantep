<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Arif',
            'email' => 'admin@simantep.id',
            'password' => Hash::make('admin123'),
        ]);
    }
}
