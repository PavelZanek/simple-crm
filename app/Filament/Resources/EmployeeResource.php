<?php

namespace App\Filament\Resources;

use App\Enums\Employees\EmployeeStatusEnum;
use App\Enums\Employees\EmploymentRelationTypeEnum;
use App\Enums\Employees\ResidencePermitTypeEnum;
use App\Enums\Employees\WorkPermitTypeEnum;
use App\Enums\GenderEnum;
use App\Filament\Concerns\HasCreatedAtFilter;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Helpers\ProjectHelper;
use App\Models\Country;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeCompany;
use App\Models\Nationality;
use App\Models\Role;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Override;

class EmployeeResource extends Resource
{
    use HasCreatedAtFilter;

    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    #[Override]
    public static function getNavigationLabel(): string
    {
        return __('app/employee-resource.navigation_label');
    }

    #[Override]
    public static function getBreadcrumb(): string
    {
        return __('app/employee-resource.breadcrumb');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Wizard::make([
                // First Part – Personal Information
                Forms\Components\Wizard\Step::make(__('app/employee-resource.edit.wizard.step1'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('id_number')
                                    ->label(__('app/employee-resource.attributes.id_number'))
                                    ->maxLength(50)
                                    ->nullable(),
                                Forms\Components\TextInput::make('vat_number')
                                    ->label(__('app/employee-resource.attributes.vat_number'))
                                    ->maxLength(50)
                                    ->nullable(),
                                Forms\Components\Select::make('status')
                                    ->label(__('app/employee-resource.attributes.status'))
                                    ->options(
                                        EmployeeStatusEnum::all()
                                            ->mapWithKeys(fn(array $item) => [$item['value'] => $item['name']])
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
                            ])->columns(4),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->label(__('app/employee-resource.attributes.first_name'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('last_name')
                                    ->label(__('app/employee-resource.attributes.last_name'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('family_name')
                                    ->label(__('app/employee-resource.attributes.family_name'))
                                    ->maxLength(255)
                                    ->nullable(),
                            ])->columns(3),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('passport_number')
                                    ->label(__('app/employee-resource.attributes.passport_number'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('issuing_authority_name')
                                    ->label(__('app/employee-resource.attributes.issuing_authority_name'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('visa_number')
                                    ->label(__('app/employee-resource.attributes.visa_number'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\Select::make('residence_permit_type')
                                    ->label(__('app/employee-resource.attributes.residence_permit_type'))
                                    ->options(
                                        ResidencePermitTypeEnum::all()
                                            ->mapWithKeys(fn(array $item) => [$item['value'] => $item['name']])
                                            ->toArray()
                                    )
                                    ->nullable(),
                            ])->columns(4),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('health_insurance')
                                    ->label(__('app/employee-resource.attributes.health_insurance'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\DatePicker::make('birth_date')
                                    ->label(__('app/employee-resource.attributes.birth_date'))
                                    ->nullable(),
                                Forms\Components\TextInput::make('birth_number')
                                    ->label(__('app/employee-resource.attributes.birth_number'))
                                    ->maxLength(255)
                                    ->nullable(),
                            ])->columns(3),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('street')
                                    ->label(__('app/employee-resource.attributes.street'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('house_number')
                                    ->label(__('app/employee-resource.attributes.house_number'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('city')
                                    ->label(__('app/employee-resource.attributes.city'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('postal_code')
                                    ->label(__('app/employee-resource.attributes.postal_code'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('country')
                                    ->label(__('app/employee-resource.attributes.country'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\Select::make('country_id')
                                    ->label(__('app/employee-resource.attributes.country_id'))
                                    ->options(function () {
                                        Country::query()->orderBy('name')->pluck('name', 'id')->toArray();
                                    })
                                    ->nullable(),
                                Forms\Components\TextInput::make('nationality')
                                    ->label(__('app/employee-resource.attributes.nationality'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\Select::make('nationality_id')
                                    ->label(__('app/employee-resource.attributes.nationality_id'))
                                    ->options(function () {
                                        Nationality::query()->orderBy('name')->pluck('name', 'id')->toArray();
                                    })
                                    ->nullable(),
                                Forms\Components\TextInput::make('hostel_cr_street')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_street'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('hostel_cr_house_number')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_house_number'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('hostel_cr_city')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_city'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('hostel_cr_postal_code')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_postal_code'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('telephone_abroad')
                                    ->label(__('app/employee-resource.attributes.telephone_abroad'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('telephone_cr')
                                    ->label(__('app/employee-resource.attributes.telephone_cr'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('shoe_size')
                                    ->label(__('app/employee-resource.attributes.shoe_size'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('t_shirt_size')
                                    ->label(__('app/employee-resource.attributes.t_shirt_size'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('achieved_education')
                                    ->label(__('app/employee-resource.attributes.achieved_education'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('field_of_education')
                                    ->label(__('app/employee-resource.attributes.field_of_education'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('account_number_cr')
                                    ->label(__('app/employee-resource.attributes.account_number_cr'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('languages')
                                    ->label(__('app/employee-resource.attributes.languages'))
                                    ->maxLength(255)
                                    ->nullable(),
                            ])->columns(4),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Textarea::make('previous_experience')
                                    ->label(__('app/employee-resource.attributes.previous_experience'))
                                    ->nullable(),
                                Forms\Components\Toggle::make('is_first_job_cr')
                                    ->label(__('app/employee-resource.attributes.is_first_job_cr'))
                                    ->nullable(),
                            ])->columns(),
                    ]),
                // Second Part – Employment Details
                Forms\Components\Wizard\Step::make(__('app/employee-resource.edit.wizard.step2'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('work_permit_type')
                                    ->label(__('app/employee-resource.attributes.work_permit_type'))
                                    ->options(
                                        WorkPermitTypeEnum::all()
                                            ->mapWithKeys(fn(array $item) => [$item['value'] => $item['name']])
                                            ->toArray()
                                    )
                                    ->nullable(),
                                Forms\Components\DatePicker::make('work_permit_validity')
                                    ->label(__('app/employee-resource.attributes.work_permit_validity'))
                                    ->nullable(),
                                Forms\Components\TextInput::make('registration_number_cssz')
                                    ->label(__('app/employee-resource.attributes.registration_number_cssz'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\DatePicker::make('date_of_employment')
                                    ->label(__('app/employee-resource.attributes.date_of_employment'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('date_of_termination_of_employment')
                                    ->label(__('app/employee-resource.attributes.date_of_termination_of_employment'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('actual_date_of_last_shift')
                                    ->label(__('app/employee-resource.attributes.actual_date_of_last_shift'))
                                    ->nullable(),
                                Forms\Components\Select::make('employment_relationship_type')
                                    ->label(__('app/employee-resource.attributes.employment_relationship_type'))
                                    ->options(
                                        EmploymentRelationTypeEnum::all()
                                            ->mapWithKeys(fn(array $item) => [$item['value'] => $item['name']])
                                            ->toArray()
                                    )
                                    ->nullable(),
                                Forms\Components\TextInput::make('temporary_assignment_user_company_name')
                                    ->label(__('app/employee-resource.attributes.temporary_assignment_user_company_name'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\Select::make('employee_company_id')
                                    ->label(__('app/employee-resource.attributes.employee_company_id'))
                                    ->options(function () {
                                        EmployeeCompany::query()->orderBy('name')->pluck('name', 'id')->toArray();
                                    })
                                    ->nullable(),
                                Forms\Components\TextInput::make('work_address_street')
                                    ->label(__('app/employee-resource.attributes.work_address_street'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('work_address_house_number')
                                    ->label(__('app/employee-resource.attributes.work_address_house_number'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('work_address_city')
                                    ->label(__('app/employee-resource.attributes.work_address_city'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('work_address_postal_code')
                                    ->label(__('app/employee-resource.attributes.work_address_postal_code'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('classification_cz_isco')
                                    ->label(__('app/employee-resource.attributes.classification_cz_isco'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('profession_code_cz_isco')
                                    ->label(__('app/employee-resource.attributes.profession_code_cz_isco'))
                                    ->maxLength(255)
                                    ->nullable(),
                                Forms\Components\TextInput::make('classification_cz_nace')
                                    ->label(__('app/employee-resource.attributes.classification_cz_nace'))
                                    ->maxLength(255)
                                    ->nullable(),
                            ])->columns(4),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\DatePicker::make('start_date_hpp')
                                    ->label(__('app/employee-resource.attributes.start_date_hpp'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('end_date_hpp')
                                    ->label(__('app/employee-resource.attributes.end_date_hpp'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('start_date_dpc')
                                    ->label(__('app/employee-resource.attributes.start_date_dpc'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('end_date_dpc')
                                    ->label(__('app/employee-resource.attributes.end_date_dpc'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('start_date_dpp')
                                    ->label(__('app/employee-resource.attributes.start_date_dpp'))
                                    ->nullable(),
                                Forms\Components\DatePicker::make('end_date_dpp')
                                    ->label(__('app/employee-resource.attributes.end_date_dpp'))
                                    ->nullable(),
                            ])->columns()

                    ]),
                // Third Part – Other Information
                Forms\Components\Wizard\Step::make(__('app/employee-resource.edit.wizard.step3'))
                    ->schema([
                        Forms\Components\Textarea::make('note')
                            ->label(__('app/employee-resource.attributes.note'))
                            ->maxLength(1000)
                            ->nullable(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->label(__('app/employee-resource.attributes.avatar'))
                            ->image()
                            ->maxSize(1024)
                            ->maxFiles(1)
                            ->nullable()
                            ->visibleOn('edit'),
                    ]),
            ])
            ->columnSpanFull()
            ->skippable()
            ->persistStepInQueryString()
        ])->statePath('data')->model(Employee::class);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query): void {
                $query->with('user');
            })
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('common.id'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('deleted_at')
                    ->label(__('common.is_deleted'))
                    ->state(function (Employee $record): bool {
                        // @codeCoverageIgnoreStart
                        return (bool) $record->deleted_at;
                        // @codeCoverageIgnoreEnd
                    })
                    ->icon(fn (string $state): string =>
                        $state === '' || $state === '0' ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle'
                    )
                    ->color(fn (string $state): string =>
                        $state === '' || $state === '0' ? 'danger' : 'success'
                    )
                    ->boolean()
                    ->visible(fn (Tables\Contracts\HasTable $livewire): bool =>
                        isset($livewire->getTableFilterState('trashed')['value']) &&
                        $livewire->getTableFilterState('trashed')['value'] === '1'
                    ),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(__('app/employee-resource.attributes.last_name'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label(__('app/employee-resource.attributes.first_name'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('common.created_by'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->toggleable()
                    ->visible(fn (): bool => auth()->user()?->hasAnyRole(Role::SUPER_ADMIN, Role::ADMIN)),
                Tables\Columns\TextColumn::make('date_of_employment')
                    ->label(__('app/employee-resource.attributes.date_of_employment'))
                    ->date(__('common.formats.date'))
                    ->searchable(isGlobal: false)
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('date_of_termination_of_employment')
                    ->label(__('app/employee-resource.attributes.date_of_termination_of_employment'))
                    ->date(__('common.formats.date'))
                    ->searchable(isGlobal: false)
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('common.created_at'))
                    ->dateTime(__('common.formats.datetime'))
                    ->searchable(isGlobal: false)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('common.updated_at'))
                    ->dateTime(__('common.formats.datetime'))
                    ->searchable(isGlobal: false)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('employment_dates')
                    ->form([
                        Forms\Components\DatePicker::make('date_of_employment')
                            ->label(__('app/employee-resource.filters.date_of_employment_from')),
                        Forms\Components\DatePicker::make('date_of_termination_of_employment')
                            ->label(__('app/employee-resource.filters.date_of_termination_of_employment_until')),
                    ])
                    // @codeCoverageIgnoreStart
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_of_employment'],
                                function (Builder $query, mixed $date): Builder {
                                    /** @var ?string $date */
                                    return $query->whereDate('date_of_employment', '>=', $date);
                                },
                            )
                            ->when(
                                $data['date_of_termination_of_employment'],
                                function (Builder $query, mixed $date): Builder {
                                    /** @var ?string $date */
                                    return $query->whereDate('date_of_termination_of_employment', '<=', $date);
                                },
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['date_of_employment'] ?? null) {
                            // @phpstan-ignore-next-line
                            $indicators[] = Tables\Filters\Indicator::make(
                                __('app/employee-resource.filters.date_of_employment_from')
                                .' '
                                .Carbon::parse($data['date_of_employment'])->translatedFormat(__('common.formats.date_string'))
                            )->removeField('date_of_employment');
                        }

                        if ($data['date_of_termination_of_employment'] ?? null) {
                            // @phpstan-ignore-next-line
                            $indicators[] = Tables\Filters\Indicator::make(
                                __('app/employee-resource.filters.date_of_termination_of_employment_until')
                                .' '
                                .Carbon::parse($data['date_of_termination_of_employment'])->translatedFormat(__('common.formats.date_string'))
                            )->removeField('date_of_termination_of_employment');
                        }

                        return $indicators;
                    }),
                // @codeCoverageIgnoreEnd
                self::createdAtFilter(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->button(),
                Tables\Actions\EditAction::make()
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('app/employee-resource.actions.modals.delete.bulk.heading'))
                        ->modalDescription(__('app/employee-resource.actions.modals.delete.bulk.description')),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->modalHeading(__('app/employee-resource.actions.modals.force_delete.bulk.heading'))
                        ->modalDescription(__('app/employee-resource.actions.modals.force_delete.bulk.description')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->modalHeading(__('app/employee-resource.actions.modals.restore.bulk.heading'))
                        ->modalDescription(__('app/employee-resource.actions.modals.restore.bulk.description')),
                ]),
            ])
            ->defaultSort('last_name')
            ->paginated(ProjectHelper::getRecordsPerPageOptions())
            ->defaultPaginationPageOption(ProjectHelper::getRecordsPerPageDefaultOption());
    }

    #[Override]
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Tabs::make('tabs')
                ->tabs([
                    Infolists\Components\Tabs\Tab::make(__('app/employee-resource.edit.wizard.step1'))
                        ->schema([
                            Infolists\Components\Grid::make(3)->schema([
                                TextEntry::make('first_name')
                                    ->label(__('app/employee-resource.attributes.first_name')),
                                TextEntry::make('last_name')
                                    ->label(__('app/employee-resource.attributes.last_name')),
                                TextEntry::make('family_name')
                                    ->label(__('app/employee-resource.attributes.family_name')),
                            ]),
                            Infolists\Components\Grid::make(3)->schema([
                                TextEntry::make('health_insurance')
                                    ->label(__('app/employee-resource.attributes.health_insurance')),
                                TextEntry::make('birth_date')
                                    ->label(__('app/employee-resource.attributes.birth_date'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('birth_number')
                                    ->label(__('app/employee-resource.attributes.birth_number')),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('id_number')
                                    ->label(__('app/employee-resource.attributes.id_number')),
                                TextEntry::make('vat_number')
                                    ->label(__('app/employee-resource.attributes.vat_number')),
                                TextEntry::make('status')
                                    ->label(__('app/employee-resource.attributes.status'))
                                    ->formatStateUsing(function (EmployeeStatusEnum $state): string {
                                        return $state->details()['name'];
                                    }),
                                TextEntry::make('gender')
                                    ->label(__('app/employee-resource.attributes.gender'))
                                    ->formatStateUsing(function (GenderEnum $state): string {
                                        return $state->details()['name'];
                                    }),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('passport_number')
                                    ->label(__('app/employee-resource.attributes.passport_number')),
                                TextEntry::make('issuing_authority_name')
                                    ->label(__('app/employee-resource.attributes.issuing_authority_name')),
                                TextEntry::make('visa_number')
                                    ->label(__('app/employee-resource.attributes.visa_number')),
                                TextEntry::make('residence_permit_type')
                                    ->label(__('app/employee-resource.attributes.residence_permit_type'))
                                    ->formatStateUsing(function (ResidencePermitTypeEnum $state): string {
                                        return $state->details()['name'];
                                    }),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('street')
                                    ->label(__('app/employee-resource.attributes.street')),
                                TextEntry::make('house_number')
                                    ->label(__('app/employee-resource.attributes.house_number')),
                                TextEntry::make('city')
                                    ->label(__('app/employee-resource.attributes.city')),
                                TextEntry::make('postal_code')
                                    ->label(__('app/employee-resource.attributes.postal_code')),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('country')
                                    ->label(__('app/employee-resource.attributes.country')),
                                TextEntry::make('country.name')
                                    ->label(__('app/employee-resource.attributes.country_id')),
                                TextEntry::make('nationality')
                                    ->label(__('app/employee-resource.attributes.nationality')),
                                TextEntry::make('nationality.name')
                                    ->label(__('app/employee-resource.attributes.nationality_id')),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('hostel_cr_street')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_street')),
                                TextEntry::make('hostel_cr_house_number')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_house_number')),
                                TextEntry::make('hostel_cr_city')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_city')),
                                TextEntry::make('hostel_cr_postal_code')
                                    ->label(__('app/employee-resource.attributes.hostel_cr_postal_code')),
                                TextEntry::make('telephone_abroad')
                                    ->label(__('app/employee-resource.attributes.telephone_abroad')),
                                TextEntry::make('telephone_cr')
                                    ->label(__('app/employee-resource.attributes.telephone_cr')),
                                TextEntry::make('shoe_size')
                                    ->label(__('app/employee-resource.attributes.shoe_size')),
                                TextEntry::make('t_shirt_size')
                                    ->label(__('app/employee-resource.attributes.t_shirt_size')),
                                TextEntry::make('achieved_education')
                                    ->label(__('app/employee-resource.attributes.achieved_education')),
                                TextEntry::make('field_of_education')
                                    ->label(__('app/employee-resource.attributes.field_of_education')),
                                TextEntry::make('previous_experience')
                                    ->label(__('app/employee-resource.attributes.previous_experience')),
                                TextEntry::make('is_first_job_cr')
                                    ->label(__('app/employee-resource.attributes.is_first_job_cr'))
                                    ->formatStateUsing(function (bool $state): string {
                                        return $state ? __('common.yes') : __('common.no');
                                    }),
                                TextEntry::make('account_number_cr')
                                    ->label(__('app/employee-resource.attributes.account_number_cr')),
                                TextEntry::make('languages')
                                    ->label(__('app/employee-resource.attributes.languages')),
                            ]),
                        ]),
                    Infolists\Components\Tabs\Tab::make(__('app/employee-resource.edit.wizard.step2'))
                        ->schema([
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('work_permit_type')
                                    ->label(__('app/employee-resource.attributes.work_permit_type'))
                                    ->formatStateUsing(function (WorkPermitTypeEnum $state): string {
                                        return $state->details()['name'];
                                    }),
                                TextEntry::make('work_permit_validity')
                                    ->label(__('app/employee-resource.attributes.work_permit_validity'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('registration_number_cssz')
                                    ->label(__('app/employee-resource.attributes.registration_number_cssz')),
                                TextEntry::make('date_of_employment')
                                    ->label(__('app/employee-resource.attributes.date_of_employment'))
                                    ->date(format: __('common.formats.date')),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('date_of_termination_of_employment')
                                    ->label(__('app/employee-resource.attributes.date_of_termination_of_employment'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('actual_date_of_last_shift')
                                    ->label(__('app/employee-resource.attributes.actual_date_of_last_shift'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('employment_relationship_type')
                                    ->label(__('app/employee-resource.attributes.employment_relationship_type'))
                                    ->formatStateUsing(function (EmploymentRelationTypeEnum $state): string {
                                        return $state->details()['name'];
                                    }),
                                TextEntry::make('temporary_assignment_user_company_name')
                                    ->label(__('app/employee-resource.attributes.temporary_assignment_user_company_name')),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('employeeCompany.name')
                                    ->label(__('app/employee-resource.attributes.employee_company_id')),
                                TextEntry::make('work_address_street')
                                    ->label(__('app/employee-resource.attributes.work_address_street')),
                                TextEntry::make('work_address_house_number')
                                    ->label(__('app/employee-resource.attributes.work_address_house_number')),
                                TextEntry::make('work_address_city')
                                    ->label(__('app/employee-resource.attributes.work_address_city')),
                            ]),
                            Infolists\Components\Grid::make(4)->schema([
                                TextEntry::make('work_address_postal_code')
                                    ->label(__('app/employee-resource.attributes.work_address_postal_code')),
                                TextEntry::make('classification_cz_isco')
                                    ->label(__('app/employee-resource.attributes.classification_cz_isco')),
                                TextEntry::make('profession_code_cz_isco')
                                    ->label(__('app/employee-resource.attributes.profession_code_cz_isco')),
                                TextEntry::make('classification_cz_nace')
                                    ->label(__('app/employee-resource.attributes.classification_cz_nace')),
                            ]),
                            Infolists\Components\Grid::make(6)->schema([
                                TextEntry::make('start_date_hpp')
                                    ->label(__('app/employee-resource.attributes.start_date_hpp'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('end_date_hpp')
                                    ->label(__('app/employee-resource.attributes.end_date_hpp'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('start_date_dpc')
                                    ->label(__('app/employee-resource.attributes.start_date_dpc'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('end_date_dpc')
                                    ->label(__('app/employee-resource.attributes.end_date_dpc'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('start_date_dpp')
                                    ->label(__('app/employee-resource.attributes.start_date_dpp'))
                                    ->date(format: __('common.formats.date')),
                                TextEntry::make('end_date_dpp')
                                    ->label(__('app/employee-resource.attributes.end_date_dpp'))
                                    ->date(format: __('common.formats.date')),
                            ]),
                        ]),
                    Infolists\Components\Tabs\Tab::make(__('app/employee-resource.edit.wizard.step3'))
                        ->schema([
                            Infolists\Components\Grid::make(1)->schema([
                                TextEntry::make('note')
                                    ->label(__('app/employee-resource.attributes.note')),
                            ]),
                        ]),
                ])->columnSpanFull(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
//            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);

        if (! auth()->user()->hasAnyRole(Role::ADMIN, Role::SUPER_ADMIN)) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }
}
