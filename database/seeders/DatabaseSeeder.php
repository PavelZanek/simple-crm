<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\Employees\EmployeeCompanySeeder;
use Database\Seeders\Employees\EmployeeDocumentSeeder;
use Database\Seeders\Employees\EmployeeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $localSeeders = [];
        if (app()->environment('local')) {
            $localSeeders = [
                FakeUserSeeder::class,
                CountrySeeder::class,
                EmployeeCompanySeeder::class,
                EmployeeDocumentSeeder::class,
                EmployeeSeeder::class,
            ];
        }

        $this->call([
            RoleSeeder::class,
            // ShieldSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            ...$localSeeders,
        ]);
    }
}
