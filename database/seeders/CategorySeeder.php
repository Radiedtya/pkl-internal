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
                'name' => 'Sepatu',
                'slug' => 'sepatu',
                'description' => 'Berbagai jenis sepatu untuk pria dan wanita',
                'is_active' => true,
            ],
            [
                'name' => 'Jersey Bola Pria',
                'slug' => 'jersey-bola-pria',
                'description' => 'Jersey bola pria untuk berbagai tim dan liga',
                'is_active' => true,
            ],
            [
                'name' => 'Jersey Bola Wanita',
                'slug' => 'jersey-bola-wanita',
                'description' => 'Jersey bola wanita untuk berbagai tim dan liga',
                'is_active' => true,
            ],
            [
                'name' => 'Aksesoris Olahraga',
                'slug' => 'aksesoris-olahraga',
                'description' => 'Aksesoris olahraga seperti tas, botol minum, dan lainnya',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Categories seeded successfully!');
    }
}