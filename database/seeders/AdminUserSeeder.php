<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mettacity.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Globaltronics@2026!'),
                'is_admin' => true,
            ]
        );

        echo "Admin user created!\n";
        echo "Email: admin@mettacity.com\n";
        echo "Password: Globaltronics@2026!\n";
    }
}
