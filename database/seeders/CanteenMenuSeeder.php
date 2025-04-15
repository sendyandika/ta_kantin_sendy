<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CanteenMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('canteen_menus')->insert([
            ['name' => 'Nasi Goreng', 'price' => 15000, 'image' => 'nasigoreng.jpg'],
            ['name' => 'Ayam Bakar', 'price' => 20000, 'image' => 'ayambakar.jpg'],
            ['name' => 'Mie Goreng', 'price' => 12000, 'image' => 'miegoreng.jpg'],
        ]);
    }
}
