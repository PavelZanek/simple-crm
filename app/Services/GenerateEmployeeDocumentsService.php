<?php

namespace App\Services;

use App\Enums\CastTypeEnum;
use App\Enums\Employees\EmployeeStatusEnum;
use App\Enums\Employees\ResidencePermitTypeEnum;
use App\Enums\Employees\WorkPermitTypeEnum;
use App\Enums\GenderEnum;
use App\Models\Country;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeCompany;
use App\Models\Employees\EmployeeDocument;
use App\Models\Nationality;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;

class GenerateEmployeeDocumentsService
{
    /**
     * Generate a document based on a template and data
     *
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function generateDocument(EmployeeDocument $employeeDocument, array $data): ?string
    {
        $media = $employeeDocument->getFirstMedia('document');

        if ($media) {
            $templatePath = $media->getPath();
            $templateProcessor = new TemplateProcessor($templatePath);
            $this->setTemplateValues($templateProcessor, $data);

            $employeeFullName = $data['first_name'].' '.$data['last_name'];
            $sluggedEmployeeFullName = Str::slug($employeeFullName);
            $sluggedTemplateName = Str::slug($employeeDocument->name);

            $outputPath = storage_path(
                'app/public/'.uniqid($sluggedEmployeeFullName.'-'.$sluggedTemplateName.'-', true).'.docx'
            );
            $templateProcessor->saveAs($outputPath);

            return $outputPath;
        } else {
            return null;
        }
    }

    /**
     * Set values in the template processor
     */
    private function setTemplateValues(TemplateProcessor $templateProcessor, array $data): void
    {
        unset(
            $data['id'],
            $data['user_id'],
            $data['is_created_from_import'],
            $data['created_at'],
            $data['updated_at'],
            $data['deleted_at'],
        );

        foreach ($data as $key => $value) {
            $camelCaseKey = Str::camel($key);

            if (is_bool($value)) {
                $value = $value ? __('common.yes') : __('common.no');
            }

            if ($value) {
                $employee = new Employee;
                $isDateType = (isset($employee->getCasts()[$key]) && $employee->getCasts()[$key] === CastTypeEnum::DATE);
                $isDateTimeType = (isset($employee->getCasts()[$key]) && $employee->getCasts()[$key] === CastTypeEnum::DATETIME);

                if ($isDateType) {
                    $value = Carbon::parse($value)->format('d.m.Y');
                } elseif ($isDateTimeType) {
                    $value = Carbon::parse($value)->format('d.m.Y H:i:s');
                }

                if ($key === 'country_id') {
                    $value = Country::query()->find($value)?->name;
                } elseif ($key === 'nationality_id') {
                    $value = Nationality::query()->find($value)?->name;
                } elseif ($key === 'employee_company_id') {
                    $value = EmployeeCompany::query()->find($value)?->name;
                }

                if ($key === 'work_permit_type' && in_array($value, WorkPermitTypeEnum::values(), true)) {
                    $value = WorkPermitTypeEnum::from($value)->details()['name'];
                } elseif ($key === 'gender' && in_array($value, GenderEnum::values(), true)) {
                    $value = GenderEnum::from($value)->details()['name'];
                } elseif ($key === 'status' && in_array($value, EmployeeStatusEnum::values(), true)) {
                    $value = EmployeeStatusEnum::from($value)->details()['name'];
                } elseif ($key === 'residence_permit_type' && in_array($value, ResidencePermitTypeEnum::values(), true)) {
                    $value = ResidencePermitTypeEnum::from($value)->details()['name'];
                }
            }

            $templateProcessor->setValue($camelCaseKey, $value ?? '');
        }
    }

    /**
     * Create a zip file containing the given files
     *
     * @throws \PhpOffice\PhpWord\Exception\Exception
     * @throws \Exception
     */
    public function createZipFile(Employee $employee, array $files): string
    {
        $timestamp = now()->format('YmdHis');
        $employeeFullName = $employee->first_name.' '.$employee->last_name;
        $sluggedEmployeeFullName = Str::slug($employeeFullName);
        $zipFilename = "{$sluggedEmployeeFullName}-{$timestamp}.zip";
        $zipFilePath = storage_path("app/public/{$zipFilename}");

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        } else {
            throw new \Exception('Failed to create zip file');
        }

        // Register shutdown function to delete temporary files
        register_shutdown_function(function () use ($files, $zipFilePath) {
            foreach ($files as $file) {
                @unlink($file);
            }
            @unlink($zipFilePath);
        });

        return $zipFilePath;
    }
}
