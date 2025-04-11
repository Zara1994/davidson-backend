<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Tile & Surface',
                'description' => 'Some text...',
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tile & Surface',
                'description' => 'Some text...',
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tile & Surface',
                'description' => 'Some text...',
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tile & Surface',
                'description' => 'Some text...',
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tile & Surface',
                'description' => 'Some text...',
                'image' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],



        ]);
    }
}
