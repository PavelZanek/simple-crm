<?php

declare(strict_types=1);

namespace App\Enums\Employees;

use Illuminate\Support\Collection;

enum EmployeeStatusEnum: string
{
    case CANDIDATE = 'candidate';
    case EMPLOYEE = 'employee';
    case TERMINATED = 'terminated';

    public static function values(): array
    {
        return array_column(EmployeeStatusEnum::cases(), 'value');
    }

    public static function all(): Collection
    {
        return collect(EmployeeStatusEnum::cases())->map(
            fn (EmployeeStatusEnum $code) => $code->details()
        );
    }

    public static function allForFilter(): Collection
    {
        return collect(EmployeeStatusEnum::cases())->mapWithKeys(
            fn (EmployeeStatusEnum $code) => [$code->details()['value'] => $code->details()['name']]
        );
    }

    /**
     * @return array<string, string>
     */
    public function details(): array
    {
        return match ($this) {
            self::CANDIDATE => [
                'name' => __('app/employee-resource.enums.employee_status.candidate'),
                'value' => 'candidate',
            ],

            self::EMPLOYEE => [
                'name' => __('app/employee-resource.enums.employee_status.employee'),
                'value' => 'employee',
            ],

            self::TERMINATED => [
                'name' => __('app/employee-resource.enums.employee_status.terminated'),
                'value' => 'terminated',
            ],
        };
    }
}
