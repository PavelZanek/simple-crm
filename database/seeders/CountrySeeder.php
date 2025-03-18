<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'ČR'],
            ['name' => 'Slovensko'],
            ['name' => 'Polsko'],
            ['name' => 'Ukrajina'],
            ['name' => 'Rumunsko'],
            ['name' => 'Mongolsko'],
            ['name' => 'Nepál'],
            ['name' => 'Indie'],
            ['name' => 'Mexiko'],
            ['name' => 'Gruzie'],
            ['name' => 'Moldávie'],
            ['name' => 'Filipíny'],
            ['name' => 'Kazachstán'],
            ['name' => 'Arménie'],
            ['name' => 'Kyrgyzstán'],
            ['name' => 'Bělorusko'],
            ['name' => 'Maďarsko'],
            ['name' => 'Bulharsko'],
            ['name' => 'Uzbekistán'],
        ];

        foreach ($countries as $country) {
            Country::query()->updateOrCreate($country);
        }
    }
}
