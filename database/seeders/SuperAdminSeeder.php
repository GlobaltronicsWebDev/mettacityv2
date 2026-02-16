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
                'password' => Hash::make('superadmin123'),
                'is_admin' => true,
                'is_super_admin' => true,
            ]
        );
    }
}
