<?php

declare(strict_types=1);

namespace App\Filament\Concerns;

use Carbon\Carbon;
use Filament\Tables\Filters;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasCreatedAtFilter
 *
 * Provides a reusable created_at filter for Filament resources.
 */
trait HasCreatedAtFilter
{
    /**
     * Returns the created_at filter instance.
     *
     * @return \Filament\Tables\Filters\Filter
     * @throws \Exception
     */
    public static function createdAtFilter(): Filters\Filter
    {
        return Filters\Filter::make('created_at')
            ->form([
                Forms\Components\DatePicker::make('created_from')
                    ->label(__('common.created_from')),
                Forms\Components\DatePicker::make('created_until')
                    ->label(__('common.created_until')),
            ])
            // @codeCoverageIgnoreStart
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['created_from'],
                        function (Builder $query, mixed $date): Builder {
                            /** @var ?string $date */
                            return $query->whereDate('created_at', '>=', $date);
                        },
                    )
                    ->when(
                        $data['created_until'],
                        function (Builder $query, mixed $date): Builder {
                            /** @var ?string $date */
                            return $query->whereDate('created_at', '<=', $date);
                        },
                    );
            })
            ->indicateUsing(function (array $data): array {
                $indicators = [];

                if ($data['created_from'] ?? null) {
                    // @phpstan-ignore-next-line
                    $indicators[] = Filters\Indicator::make(__('common.created_from').' '.Carbon::parse($data['created_from'])->translatedFormat(__('common.formats.date_string')))
                        ->removeField('created_from');
                }

                if ($data['created_until'] ?? null) {
                    // @phpstan-ignore-next-line
                    $indicators[] = Filters\Indicator::make(__('common.created_until').' '.Carbon::parse($data['created_until'])->translatedFormat(__('common.formats.date_string')))
                        ->removeField('created_until');
                }

                return $indicators;
            });
            // @codeCoverageIgnoreEnd
    }
}
