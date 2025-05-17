<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Électronique'],
            ['name' => 'Vêtements'],
            ['name' => 'Maison'],
            ['name' => 'Jouets'],
            ['name' => 'Livres'],
        ]);
    }
}
