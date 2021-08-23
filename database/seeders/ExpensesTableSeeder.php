<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new = new \DateTime();

        DB::table('expenses')->insert([
            'name' => 'Бонус найкращому',
            'description' => 'Бонус за найкращі показники',
            'amount' => 200,
            'type' => 0,
            'created_at' => $new,
            'updated_at' => $new
        ]);

        DB::table('expenses')->insert([
            'name' => 'Процент від суми замовлень',
            'description' => 'Компанія кожного місяця начисляє 3% від суми замовлень',
            'amount' => 3,
            'type' => 1,//fixed=0, percentage=1, calculated=2 
            'created_at' => $new,
            'updated_at' => $new
        ]);
    }
}
