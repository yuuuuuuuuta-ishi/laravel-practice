<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Log;


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
        $codeString =User::getLatestCode();
        log::info($codeString);
        $codeInt = empty($codeString['code']) ? 1 : (int)$codeString['code'] + 1;
        log::info($codeInt);
        $code = str_pad($codeInt, 5, 0, STR_PAD_LEFT);
        $department = ['総務部','経理部', '人事部', '営業部', '開発部'];
        $branch = ['本社','東北支店', '東海支店', '近畿支店', '中国支店', '四国支店', '九州支店'];
        $postList = ['係長','主任', '一般社員', '一般社員', '一般社員'];
        $post = $postList[array_rand($postList)];
        $is_admin = $post !== '一般社員';
        return [
            'code' => $code
            , 'name' => fake()->name
            , 'password' => fake()->password
            // , 'branch' => $branch[array_rand($branch)]
            // , 'department' => $department[array_rand($department)]
            // , 'post' => $post
            // , 'entry_date' => fake()->date
            // , 'age' => fake()->numberBetween(18,80)
            // , 'is_admin' => $is_admin
        ];
    }
}
