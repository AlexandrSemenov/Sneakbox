<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['35', '35-36', '36', '36-37', '37', '37-38', '38', '38-39', '39', '39-40', '40', '40-41', '41', '41-42', '42', '42-43',
            '43', '43-44', '44', '44-45', '45', '46', '47', '48', '49'
        ];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'name' => $size,
            ]);
        }
    }
}
