<?php

declare(strict_types=1);

namespace Database\Seeders\Employees;

use App\Models\Employees\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::query()->pluck('id')->toArray();

        $employees = Employee::factory(150)->create([
            'user_id' => function () use ($userIds) {
                return $userIds[0];
            },
        ]);

        $employees->each(function (Employee $employee) use ($userIds) {
            $employee->update([
                'user_id' => $userIds[array_rand($userIds)],
            ]);
        });
    }
}
