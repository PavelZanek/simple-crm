<?php

declare(strict_types=1);

namespace App\Enums\Employees;

use Illuminate\Support\Collection;

enum ResidencePermitTypeEnum: string
{
    case DO = 'do';
    case SD = 'sd';
    case CARD = 'card';
    case EU = 'eu';

    public static function values(): array
    {
        return array_column(ResidencePermitTypeEnum::cases(), 'value');
    }

    public static function all(): Collection
    {
        return collect(ResidencePermitTypeEnum::cases())->map(
            fn (ResidencePermitTypeEnum $code) => $code->details()
        );
    }

    public static function allForFilter(): Collection
    {
        return collect(ResidencePermitTypeEnum::cases())->mapWithKeys(
            fn (ResidencePermitTypeEnum $code) => [$code->details()['value'] => $code->details()['name']]
        );
    }

    /**
     * @return array<string, string>
     */
    public function details(): array
    {
        return match ($this) {
            self::DO => [
                'name' => __('app/employee-resource.enums.residence_permit_type.do'),
                'value' => 'do',
            ],

            self::SD => [
                'name' => __('app/employee-resource.enums.residence_permit_type.sd'),
                'value' => 'sd',
            ],

            self::CARD => [
                'name' => __('app/employee-resource.enums.residence_permit_type.card'),
                'value' => 'card',
            ],

            self::EU => [
                'name' => __('app/employee-resource.enums.residence_permit_type.eu'),
                'value' => 'eu',
            ],
        };
    }
}
