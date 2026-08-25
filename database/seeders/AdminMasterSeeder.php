<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminMasterSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@saudemulher.com'
            ],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('Admin@123'),
                'is_master' => true,
            ]
        );
    }
}