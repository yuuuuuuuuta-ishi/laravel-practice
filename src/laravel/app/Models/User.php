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
    public static function getUserByUserIdAndPassword(string $userId, string $password)
    {
        $query = self::query()
            ->where('user_id', $userId)
            ->where('password', $password);

        return $query->first();
    }

    /**
     * selectOneByCode
     *
     * @param  mixed $code
     * @return users $user
     */
    public static function selectOneByCode(string $userId)
    {
        $query = self::query()
            ->where('user_id', $userId);

        return $query->first();
    }

    /**
     * getAll
     *
     * @return user
     */
    public static function getAll()
    {

        return  self::paginate(10);
    }


    public static function getLatestCode()
    {

        $query = self::query()
            ->select('user_id')
            ->orderBy('user_id', 'desc')
            ->limit(1);

        return $query->first();
    }
}
