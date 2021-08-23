<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Order::factory()->count(300)->create();//Створимо 300 записів замовлень
    }
}
