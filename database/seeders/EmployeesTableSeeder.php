<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $new = new \DateTime();

        DB::table('employees')->insert([
            'phone' => '0964258671',
            'address' => 'м.Богуслав вул. Шевченко 23',
            'salary' => 500,
            'user_id' => 1,
            'created_at' => $new,
            'updated_at' => $new

        ]);
        
        DB::table('employees')->insert([
            'phone' => '0964257871',
            'address' => 'м.Вінниця вул. Надрічна 12',
            'salary' => 500,
            'user_id' => 2,            
            'created_at' => $new,
            'updated_at' => $new
        ]);

        DB::table('employees')->insert([
            'phone' => '0504657828',
            'address' => 'м.Біла Церква вул. Турчанінова 17',
            'salary' => 500,
            'user_id' => 3,            
            'created_at' => $new,
            'updated_at' => $new
        ]);

        DB::table('employees')->insert([
            'phone' => '0963278127',
            'address' => 'м.Фастів вул. Гагаріна 27',
            'salary' => 500,
            'user_id' => 4,            
            'created_at' => $new,
            'updated_at' => $new
        ]);
        
        DB::table('employees')->insert([
            'phone' => '0503278199',
            'address' => 'м.Фастів вул. Яблунева 10',
            'salary' => 500,
            'user_id' => 5,            
            'created_at' => $new,
            'updated_at' => $new
        ]);
    }
}
