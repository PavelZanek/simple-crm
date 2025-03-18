<?php

declare(strict_types=1);

namespace App\Enums\Employees;

use Illuminate\Support\Collection;

enum EmploymentRelationTypeEnum: string
{
    case EMPLOYMENT_RELATIONSHIP = 'employment_relationship';
    case AGREEMENT_FOR_PERFORMANCE_OF_WORK = 'agreement_for_performance_of_work';
    case AGREEMENT_ON_EMPLOYMENT = 'agreement_on_employment';
    case MAIN_EMPLOYMENT_RELATIONSHIP = 'main_employment_relationship';

    public static function values(): array
    {
        return array_column(EmploymentRelationTypeEnum::cases(), 'value');
    }

    public static function all(): Collection
    {
        return collect(EmploymentRelationTypeEnum::cases())->map(
            fn (EmploymentRelationTypeEnum $code) => $code->details()
        );
    }

    public static function allForFilter(): Collection
    {
        return collect(EmploymentRelationTypeEnum::cases())->mapWithKeys(
            fn (EmploymentRelationTypeEnum $code) => [$code->details()['value'] => $code->details()['name']]
        );
    }

    /**
     * @return array<string, string>
     */
    public function details(): array
    {
        return match ($this) {
            self::EMPLOYMENT_RELATIONSHIP => [
                'name' => __('app/employee-resource.enums.employment_relation_type.employment_relationship'),
                'value' => 'employment_relationship',
            ],

            self::AGREEMENT_FOR_PERFORMANCE_OF_WORK => [
                'name' => __('app/employee-resource.enums.employment_relation_type.agreement_for_performance_of_work'),
                'value' => 'agreement_for_performance_of_work',
            ],

            self::AGREEMENT_ON_EMPLOYMENT => [
                'name' => __('app/employee-resource.enums.employment_relation_type.agreement_on_employment'),
                'value' => 'agreement_on_employment',
            ],

            self::MAIN_EMPLOYMENT_RELATIONSHIP => [
                'name' => __('app/employee-resource.enums.employment_relation_type.main_employment_relationship'),
                'value' => 'main_employment_relationship',
            ],
        };
    }
}
