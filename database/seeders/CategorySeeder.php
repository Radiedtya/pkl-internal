<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sepatu Futsal',
                'slug' => 'sepatu-futsal',
                'description' => 'Berbagai jenis sepatu futsal untuk performa terbaik di lapangan',
                'is_active' => true,
            ],
            [
                'name' => 'Sepatu Bola',
                'slug' => 'sepatu-bola',
                'description' => 'Sepatu bola untuk berbagai jenis permukaan lapangan',
                'is_active' => true,
            ],
            [
                'name' => 'Sepatu Lari',
                'slug' => 'sepatu-lari',
                'description' => 'Sepatu lari ringan dan nyaman untuk berbagai jarak',
                'is_active' => true,
            ],
            [
                'name' => 'Jersey',
                'slug' => 'jersey',
                'description' => 'Jersey bola pria untuk berbagai tim dan liga',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Categories seeded successfully!');
    }
}