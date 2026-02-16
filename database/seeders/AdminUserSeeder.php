<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mettacity.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        echo "Admin user created!\n";
        echo "Email: admin@mettacity.com\n";
        echo "Password: admin123\n";
    }
}
