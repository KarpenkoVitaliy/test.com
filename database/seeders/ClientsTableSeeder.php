<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Client::factory()->count(50)->create();//Створимо 50 записів клієнтів

        // $new = new \DateTime();
        
        // DB::table('clients')->insert([
        //     'name' => 'Вовков Василь Петрович',
        //     'email' => 'vovkov@gmail.com',
        //     'address' => 'м.Богуслав вул. Шевченко 11',
        //     'phone' => '0964257671',
        //     'type' => 0,
        //     'remember_token' => Str::random(10),
        //     'created_at' => $new,
        //     'updated_at' => $new
        // ]);
        
        // DB::table('clients')->insert([
        //     'name' => 'Божок Петро Іванович',
        //     'email' => 'bojok121@gmail.com',
        //     'address' => 'м.Вінниця вул. Надрічна 27',
        //     'phone' => '0964244871',
        //     'type' => 1,        
        //     'remember_token' => Str::random(10),
        //     'created_at' => $new,
        //     'updated_at' => $new
        // ]);

        // DB::table('clients')->insert([
        //     'name' => 'Зінченко Світлана Миколаївна',
        //     'email' => 'zinchenko1983@ukr.net',
        //     'address' => 'м.Біла Церква вул. Турчанінова 9',
        //     'phone' => '0504627828',
        //     'type' => 0,
        //     'remember_token' => Str::random(10),
        //     'created_at' => $new,
        //     'updated_at' => $new
        // ]);

        // DB::table('clients')->insert([
        //     'name' => 'Савченко Алла Сергіївна',
        //     'email' => 'savchenko@ukr.net',
        //     'address' => 'м.Фастів вул. Гагаріна 14',
        //     'phone' => '0503278111',
        //     'type' => 0,
        //     'remember_token' => Str::random(10),        
        //     'created_at' => $new,
        //     'updated_at' => $new
        // ]);
        
        // DB::table('clients')->insert([
        //     'name' => 'Клименко Віктор Іванович',
        //     'email' => 'klymenko@ukr.net',
        //     'address' => 'м.Фастів вул. Яблунева 48',
        //     'phone' => '0961478197',
        //     'type' => 1,
        //     'remember_token' => Str::random(10),        
        //     'created_at' => $new,
        //     'updated_at' => $new
        // ]);

    }
}
