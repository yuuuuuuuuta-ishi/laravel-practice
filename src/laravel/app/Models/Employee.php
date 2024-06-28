<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
    ];

    /**
     * 社員コードとパスワードから一致するデータを取得する
     * 
     * @param string $code
     * @param string $password
     * 
     * @return Employee $employee | null
     */
    public function findByCodeAndPassword($code, $password)
    {
        $employee = $this::where('employee_code', $code)->where('password', hash('sha1', $password))->first();
        return $employee;
    }
}
