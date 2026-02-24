<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCarouselTableSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('carousels')) {
            DB::statement('CREATE TABLE carousels (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NULL,
                description TEXT NULL,
                image VARCHAR(255) NOT NULL,
                `order` INT DEFAULT 0,
                is_active TINYINT(1) DEFAULT 1,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )');
            
            $this->command->info('Carousels table created successfully!');
        } else {
            $this->command->info('Carousels table already exists.');
        }
    }
}
