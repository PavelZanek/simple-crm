<?php

declare(strict_types=1);

namespace Database\Seeders\Employees;

use App\Models\Employees\EmployeeCompany;
use Illuminate\Database\Seeder;

class EmployeeCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'Test 1, s.r.o.'],
            ['name' => 'Test 2, s.r.o.'],
            ['name' => 'Test 3, s.r.o.'],
        ];

        foreach ($companies as $company) {
            EmployeeCompany::query()->updateOrCreate($company);
        }
    }
}
