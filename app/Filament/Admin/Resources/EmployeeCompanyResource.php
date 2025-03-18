<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeCompanyResource\Pages;
use App\Filament\Admin\Resources\EmployeeCompanyResource\RelationManagers;
use App\Helpers\ProjectHelper;
use App\Models\Employees\EmployeeCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Override;

class EmployeeCompanyResource extends Resource
{
    protected static ?string $model = EmployeeCompany::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    #[Override]
    public static function getNavigationLabel(): string
    {
        return __('admin/employee-company-resource.navigation_label');
    }

    #[Override] // @phpstan-ignore-line
    public static function getNavigationGroup(): ?string
    {
        return __('admin/employee-company-resource.navigation_group');
    }

    #[Override]
    public static function getBreadcrumb(): string
    {
        return __('admin/employee-company-resource.breadcrumb');
    }

    #[Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin/employee-company-resource.attributes.name'))
                    ->required(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin/employee-company-resource.attributes.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('deleted_at')
                    ->label(__('common.is_active'))
                    ->state(function (EmployeeCompany $record): bool {
                        // @codeCoverageIgnoreStart
                        return (bool) $record->deleted_at;
                        // @codeCoverageIgnoreEnd
                    })
                    ->icon(fn (string $state): string => $state === '' || $state === '0' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->color(fn (string $state): string => $state === '' || $state === '0' ? 'success' : 'danger')
                    ->boolean()
                    ->visible(fn (Tables\Contracts\HasTable $livewire): bool => isset($livewire->getTableFilterState('trashed')['value']) &&
                        $livewire->getTableFilterState('trashed')['value'] === '1'
                    ),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('common.created_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('common.updated_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-company-resource.edit.title')),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-company-resource.actions.modals.delete.single.heading'))
                    ->modalDescription(__('admin/employee-company-resource.actions.modals.delete.single.description')),
                Tables\Actions\ForceDeleteAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-company-resource.actions.modals.force_delete.single.heading'))
                    ->modalDescription(__('admin/employee-company-resource.actions.modals.force_delete.single.description')),
                Tables\Actions\RestoreAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-company-resource.actions.modals.restore.single.heading'))
                    ->modalDescription(__('admin/employee-company-resource.actions.modals.restore.single.description')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('admin/employee-company-resource.actions.modals.delete.bulk.heading'))
                        ->modalDescription(__('admin/employee-company-resource.actions.modals.delete.bulk.description')),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->modalHeading(__('admin/employee-company-resource.actions.modals.force_delete.bulk.heading'))
                        ->modalDescription(__('admin/employee-company-resource.actions.modals.force_delete.bulk.description')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->modalHeading(__('admin/employee-company-resource.actions.modals.restore.bulk.heading'))
                        ->modalDescription(__('admin/employee-company-resource.actions.modals.restore.bulk.description')),
                ]),
            ])
            ->defaultSort('name')
            ->paginated(ProjectHelper::getRecordsPerPageOptions())
            ->defaultPaginationPageOption(ProjectHelper::getRecordsPerPageDefaultOption());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmployeeCompanies::route('/'),
        ];
    }

    /**
     * @return Builder<EmployeeCompany>
     */
    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
