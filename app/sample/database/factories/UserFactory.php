<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $department = ['総務部','経理部', '人事部'. '営業部', '開発部'];
        $post = ['係長','主任', '一般社員'. '一般社員', '一般社員'];
        return [
            'code' => str_pad(fake()->numberBetween(1,100), 4, 0, STR_PAD_LEFT)
            , 'name' => fake()->name
            , 'password' => fake()->password
            , 'branch' => fake()->city
            , 'department' => array_rand($department)
            , 'post' => array_rand($post)
            , 'entry_date' => fake()->date
            , 'age' => fake()->numberBetween(18,80)
        ];
    }
}
