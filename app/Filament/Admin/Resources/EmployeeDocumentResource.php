<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeDocumentResource\Pages;
use App\Filament\Admin\Resources\EmployeeDocumentResource\RelationManagers;
use App\Helpers\ProjectHelper;
use App\Models\Employees\EmployeeDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Override;

class EmployeeDocumentResource extends Resource
{
    protected static ?string $model = EmployeeDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    #[Override]
    public static function getNavigationLabel(): string
    {
        return __('admin/employee-document-resource.navigation_label');
    }

    #[Override] // @phpstan-ignore-line
    public static function getNavigationGroup(): ?string
    {
        return __('admin/employee-document-resource.navigation_group');
    }

    #[Override]
    public static function getBreadcrumb(): string
    {
        return __('admin/employee-document-resource.breadcrumb');
    }

    #[Override]
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin/employee-document-resource.attributes.name'))
                    ->required(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('ifile')
                    ->collection('document')
                    ->label(__('admin/employee-document-resource.attributes.document'))
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->required(fn (?EmployeeDocument $record) => $record === null || !$record->getFirstMedia('document'))
                    ->openable()
                    ->downloadable(),
            ]);
    }

    /**
     * @throws \Exception
     */
    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin/employee-document-resource.attributes.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('deleted_at')
                    ->label(__('common.is_active'))
                    ->state(function (EmployeeDocument $record): bool {
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
                    ->modalHeading(__('admin/employee-document-resource.edit.title')),
                Tables\Actions\Action::make('download')
                    ->label(__('common.download'))
                    ->button()
                    ->icon('heroicon-o-cloud-arrow-down')
                    ->url(fn (EmployeeDocument $record): string => route('employee-document.download', $record->id))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-document-resource.actions.modals.delete.single.heading'))
                    ->modalDescription(__('admin/employee-document-resource.actions.modals.delete.single.description')),
                Tables\Actions\ForceDeleteAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-document-resource.actions.modals.force_delete.single.heading'))
                    ->modalDescription(__('admin/employee-document-resource.actions.modals.force_delete.single.description')),
                Tables\Actions\RestoreAction::make()
                    ->button()
                    ->modalHeading(__('admin/employee-document-resource.actions.modals.restore.single.heading'))
                    ->modalDescription(__('admin/employee-document-resource.actions.modals.restore.single.description')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('admin/employee-document-resource.actions.modals.delete.bulk.heading'))
                        ->modalDescription(__('admin/employee-document-resource.actions.modals.delete.bulk.description')),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->modalHeading(__('admin/employee-document-resource.actions.modals.force_delete.bulk.heading'))
                        ->modalDescription(__('admin/employee-document-resource.actions.modals.force_delete.bulk.description')),
                    Tables\Actions\RestoreBulkAction::make()
                        ->modalHeading(__('admin/employee-document-resource.actions.modals.restore.bulk.heading'))
                        ->modalDescription(__('admin/employee-document-resource.actions.modals.restore.bulk.description')),
                ]),
            ])
            ->reorderable('position')
            ->defaultSort('name')
            ->paginated(ProjectHelper::getRecordsPerPageOptions())
            ->defaultPaginationPageOption(ProjectHelper::getRecordsPerPageDefaultOption());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmployeeDocuments::route('/'),
        ];
    }

    /**
     * @return Builder<EmployeeDocument>
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
