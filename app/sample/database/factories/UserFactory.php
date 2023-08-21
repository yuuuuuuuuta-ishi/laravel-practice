<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    private static int $sequence =(int)User::getLatestCode();
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $department = ['総務部','経理部', '人事部', '営業部', '開発部'];
        $post = ['係長','主任', '一般社員', '一般社員', '一般社員'];
        $branch = ['本社','東北支店', '東海支店', '近畿支店', '中国支店', '四国支店', '九州支店'];
        return [
            'code' => str_pad(self::$sequence++, 5, 0, STR_PAD_LEFT)
            , 'name' => fake()->name
            , 'password' => fake()->password
            , 'branch' => $branch[array_rand($branch)]
            , 'department' => $department[array_rand($department)]
            , 'post' => $post[array_rand($post)]
            , 'entry_date' => fake()->date
            , 'age' => fake()->numberBetween(18,80)
        ];
    }
}
