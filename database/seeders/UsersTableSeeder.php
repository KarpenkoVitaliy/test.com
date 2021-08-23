<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $new = new \DateTime();

        DB::table('users')->insert([
            'name' => 'Ковтун Василь Петрович',
            'email' => 'kovtun@gmail.com',
            'email_verified_at' => $new,
            'password' => bcrypt("a+12345"),
            'remember_token' => Str::random(10),
            'created_at' => $new,
            'updated_at' => $new
        ]);
        
        DB::table('users')->insert([
            'name' => 'Вахно Петро Іванович',
            'email' => 'vahno@gmail.com',
            'email_verified_at' => $new,
            'password' => bcrypt("a+12345"),
            'remember_token' => Str::random(10),
            'created_at' => $new,
            'updated_at' => $new
        ]);

        DB::table('users')->insert([
            'name' => 'Кравченко Вікторія Миколаївна',
            'email' => 'kravchenko@ukr.net',
            'email_verified_at' => $new,
            'password' => bcrypt("a+12345"),
            'remember_token' => Str::random(10),
            'created_at' => $new,
            'updated_at' => $new
        ]);

        DB::table('users')->insert([
            'name' => 'Бондар Олена Сергіївна',
            'email' => 'bondar@ukr.net',
            'email_verified_at' => $new,
            'password' => bcrypt("a+12345"),
            'remember_token' => Str::random(10),
            'created_at' => $new,
            'updated_at' => $new
        ]);
        
        DB::table('users')->insert([
            'name' => 'Бабаєв Віктор Олексійович',
            'email' => 'babaev@ukr.net',
            'email_verified_at' => $new,
            'password' => bcrypt("a+12345"),
            'remember_token' => Str::random(10),
            'created_at' => $new,
            'updated_at' => $new
        ]);
    }
}
