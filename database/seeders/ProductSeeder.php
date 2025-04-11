<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем все идентификаторы категорий
        $categoryIds = DB::table('categories')->pluck('id');

        // Проверяем, что категории существуют
        if ($categoryIds->isEmpty()) {
            $this->command->info('Table is empty.');
            return;
        }

        // Вставляем данные в таблицу products
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'description' => 'Product description',
                'image' => '',
                'category_id' => $categoryIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'Product description',
                'image' => '',
                'category_id' => $categoryIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'description' => 'Product description',
                'image' => '',
                'category_id' => $categoryIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 4',
                'description' => 'Product description',
                'image' => '',
                'category_id' => $categoryIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
