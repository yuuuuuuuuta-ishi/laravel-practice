<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * getUserByUserIdAndPassword
     *
     * @param  mixed $code
     * @param  mixed $password
     * @return users $user
     */
    public static function getUserByUserIdAndPassword(string $code, string $password)
    {
        $query = self::query()
            ->where('code', $code)
            ->where('password', $password);

        return $query->first();
    }

    /**
     * selectOneByCode
     *
     * @param  mixed $code
     * @return users $user
     */
    public static function selectOneByCode(string $code)
    {
        $query = self::query()
            ->where('code', $code);

        return $query->first();
    }

    public static function getAll(){

        return  self::paginate(10);
    }
}
