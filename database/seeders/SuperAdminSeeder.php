<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@mettacity.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Globaltronics@2026!'),
                'is_admin' => true,
                'is_super_admin' => true,
            ]
        );

        echo "Super Admin user created!\n";
        echo "Email: superadmin@mettacity.com\n";
        echo "Password: Globaltronics@2026!\n";
    }
}
