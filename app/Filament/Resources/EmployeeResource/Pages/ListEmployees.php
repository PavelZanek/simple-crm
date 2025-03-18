<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Enums\Employees\EmployeeStatusEnum;
use App\Enums\GenderEnum;
use App\Filament\Resources\EmployeeResource;
use App\Models\Employees\Employee;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('app/employee-resource.list.title');
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->model(Employee::class)
                ->modalHeading(__('app/employee-resource.create.title'))
                ->form([
                    //Section
                    Forms\Components\Section::make([
                        Forms\Components\TextInput::make('id_number')
                            ->label(__('app/employee-resource.attributes.id_number'))
                            ->maxLength(50)
                            ->nullable(),
                        Forms\Components\TextInput::make('vat_number')
                            ->label(__('app/employee-resource.attributes.vat_number'))
                            ->maxLength(50)
                            ->nullable(),
                        Forms\Components\TextInput::make('first_name')
                            ->label(__('app/employee-resource.attributes.first_name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->label(__('app/employee-resource.attributes.last_name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->label(__('app/employee-resource.attributes.status'))
                            ->options(
                                EmployeeStatusEnum::all()
                                    ->mapWithKeys(fn(array $item): array => [$item['value'] => $item['name']])
                                    ->toArray()
                            )
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->label(__('app/employee-resource.attributes.gender'))
                            ->options(
                                GenderEnum::all()
                                    ->mapWithKeys(fn(array $item) => [$item['value'] => $item['name']])
                                    ->toArray()
                            )
                            ->required(),
                    ])->columns(),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();

                    return $data;
                }),
        ];
    }

    public function setPage($page, $pageName = 'page'): void // @phpstan-ignore-line @pest-ignore-type
    {
        parent::setPage($page, $pageName);

        $this->dispatch('scroll-to-top');
    }
}
