<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create('ru_RU');
        //$this->faker = \Faker\Factory::create('ua_UA');
        return [
            'name' => $this->faker->name(),//sentence(rand(3, 3), variableNbWords: true), //; $this->faker->name(),
            'description' => $this->faker->text(rand(40, 100)),
            'phone' => $this->faker->e164PhoneNumber(),
            'status' => $this->faker->numberBetween(0, 4),
            'amount' => $this->faker->numberBetween(100, 10000),
            'client_id' => $this->faker->numberBetween(1, 50),
            'employee_id' => $this->faker->numberBetween(1, 5),
            'open_date' => $this->faker->DateTimeBetween('-3 month', '-2 month'),
            'close_date' => $this->faker->DateTimeBetween('-2 month', '-1 month'),
            'created_at' => $this->faker->DateTimeBetween('-4 month', '-3 month'),
            'updated_at' => $this->faker->DateTimeBetween('-2 month', '-1 days')
        ];


            // 'name', 100)->nullable(false);
            // "description");
            // 'phone'
            // 'status'//'new'=0, 'work'=1, 'pause'=2, 'cancel'=3, 'finish'=4
            // 'amount'
            // 'client_id')->nullable(false);
            // 'employee_id')->nullable(false);
            // dateTime('open_date');
            // dateTime('close_date');
            // table->timestamps();

        return [
        ];
    }


// use Faker\Genarator as Faker;

// $factory->define(\App\Models\BlogPost::class, function(Faker $faker){
//                    //речення дліною від 3 - 8 слів
//     $title = $faker->sentence(rand(3, 8), variableNbWords: true);
//     $txt = $faker->realText(rand(1000, 4000));
//     $isPublished = rand(1, 5) > 1;
//     $pass = bcrypt(str_random(16));


//     $data = [
//         'address' => $faker->address,
//         'category_id' => rand(1, 11),
//         'user_id' => (rand(1, 5) == 5) ? 1 : 2,
//         'slug' => str_slug($title);
//         'exserpt' => $faker->text(rand(40, 100)),
//         'published_at' => $faker->DateTimeBetween('-2 month', '-1 days')//Видай дату із інтервалу
//     ]
// })

// return [
//     'firstName' => $this->faker->firstName,
//     'lastName' => $this->faker->lastName,
//     'email' => $this->faker->unique()->email,
//     'phone' => $this->faker->phoneNumber,
//     'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now')
// ];

// 'title' => $this->faker->sentence(5),       
// 'img' => '/img/blank.jpg',
// 'text' => $this->faker->text,
// 'published' => $this->faker->numberBetween(0, 1),
// 'category_id' => $this->faker->numberBetween(1, 10),
// 'date' => $this->faker->date('Y-m-d', 'now'),
}
