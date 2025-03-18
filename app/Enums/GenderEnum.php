<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum GenderEnum: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public static function values(): array
    {
        return array_column(GenderEnum::cases(), 'value');
    }

    public static function all(): Collection
    {
        return collect(GenderEnum::cases())->map(
            fn (GenderEnum $code) => $code->details()
        );
    }

    public static function allForFilter(): Collection
    {
        return collect(GenderEnum::cases())->mapWithKeys(
            fn (GenderEnum $code) => [$code->details()['value'] => $code->details()['name']]
        );
    }

    /**
     * @return array<string, string>
     */
    public function details(): array
    {
        return match ($this) {
            self::MALE => [
                'name' => __('enums.gender.male'),
                'value' => 'male',
            ],

            self::FEMALE => [
                'name' => __('enums.gender.female'),
                'value' => 'female',
            ],
        };
    }
}
