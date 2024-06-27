<?php

namespace Database\Seeders;

use App\Models\Employee;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'employee_code' => '0011',
            'password' => hash('sha1', 'pass'),
            'name' => '研修 太郎',
        ]);
    }
}
