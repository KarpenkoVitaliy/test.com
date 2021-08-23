<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create('ru_RU');
        //$this->faker = \Faker\Factory::create('ua_UA');

        $type = $this->faker->numberBetween(0, 2);

        if( $type == 2){//Якщо клієнт "фірма"
            $name = $this->faker->company();
        }else{//Якщо клієнт "фіз. особа" чи "приватний підприємець"
            $name = $this->faker->name();
        }

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->e164PhoneNumber,//phoneNumber,//tollFreePhoneNumber(),
            'type' => $type,
            'remember_token' => Str::random(10),//str_random(10), //$this->faker->str_random(10), //Генерує рядок із сполученням цифр і букв
            'created_at' => $this->faker->DateTimeBetween('-4 month', '-1 month'),
            'updated_at' => $this->faker->DateTimeBetween('-1 month', '-1 days')
        ];
    }
}