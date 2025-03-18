<?php

declare(strict_types=1);

namespace Database\Seeders\Employees;

use App\Models\Employees\EmployeeDocument;
use Illuminate\Database\Seeder;

class EmployeeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialTemplates = [
            [
                'name' => 'Test',
                'path' => storage_path('initial-templates/test.docx'),
            ],
        ];

        foreach ($initialTemplates as $template) {
            $dbTemplate = EmployeeDocument::query()->updateOrCreate([
                'name' => $template['name'],
                'position' => EmployeeDocument::query()->count() + 1,
            ]);
            $dbTemplate->clearMediaCollection('document');
            $dbTemplate->copyMedia($template['path'])->toMediaCollection('document');
        }
    }
}
