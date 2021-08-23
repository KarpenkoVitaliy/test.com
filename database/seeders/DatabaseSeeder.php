<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);//Виконано
        $this->call(EmployeesTableSeeder::class);//Виконано
        $this->call(ClientsTableSeeder::class);
        $this->call(ExpensesTableSeeder::class);//Виконано
        $this->call(OrdersTableSeeder::class);
    }
}
