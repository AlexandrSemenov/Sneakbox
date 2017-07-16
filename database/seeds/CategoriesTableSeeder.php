<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Adidas', 'Asics', 'New Balance', 'Nike', 'Reebok', 'Vans', 'Converse', 'Fila', 'Saucony', 'Sperry', 'Другие'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
}
