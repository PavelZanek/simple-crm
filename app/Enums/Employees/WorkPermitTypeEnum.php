<?php

declare(strict_types=1);

namespace App\Enums\Employees;

use Illuminate\Support\Collection;

enum WorkPermitTypeEnum: string
{
    case EMPLOYMENT = 'employment_permit';
    case EMPLOYEE_CARD = 'employee_card';
    case INTRA_CORPORATE_TRANSFEREE_CARD = 'intra_corporate_transferee_card';
    case BLUE_CARD = 'blue_card';

    public static function values(): array
    {
        return array_column(WorkPermitTypeEnum::cases(), 'value');
    }

    public static function all(): Collection
    {
        return collect(WorkPermitTypeEnum::cases())->map(
            fn (WorkPermitTypeEnum $code) => $code->details()
        );
    }

    public static function allForFilter(): Collection
    {
        return collect(WorkPermitTypeEnum::cases())->mapWithKeys(
            fn (WorkPermitTypeEnum $code) => [$code->details()['value'] => $code->details()['name']]
        );
    }

    /**
     * @return array<string, string>
     */
    public function details(): array
    {
        return match ($this) {
            self::EMPLOYMENT => [
                'name' => __('app/employee-resource.enums.work_permit_type.employment_permit'),
                'value' => 'employment_permit',
            ],

            self::EMPLOYEE_CARD => [
                'name' => __('app/employee-resource.enums.work_permit_type.employee_card'),
                'value' => 'employee_card',
            ],

            self::INTRA_CORPORATE_TRANSFEREE_CARD => [
                'name' => __('app/employee-resource.enums.work_permit_type.intra_corporate_transferee_card'),
                'value' => 'intra_corporate_transferee_card',
            ],

            self::BLUE_CARD => [
                'name' => __('app/employee-resource.enums.work_permit_type.blue_card'),
                'value' => 'blue_card',
            ],
        };
    }
}
