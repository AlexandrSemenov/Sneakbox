<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conditions = ['Новые', 'Б/у (Отличное состояние)', 'Б/у (Хорошее состояние)', 'Б/у (Плохое состояние)'];

        foreach ($conditions as $condition) {
            DB::table('conditions')->insert([
                'name' => $condition,
            ]);
        }
    }
}
