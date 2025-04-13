<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем все идентификаторы категорий


        // Вставляем данные в таблицу products
        DB::table('projects')->insert([
            [
                'name' => 'project 1',
                'description' => 'project description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'project 2',
                'description' => 'project description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'project 3',
                'description' => 'project description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'project 4',
                'description' => 'project description',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }

}
