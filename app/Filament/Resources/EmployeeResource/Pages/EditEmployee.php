<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employees\Employee;
use App\Models\Role;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Js;
use Override;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('app/employee-resource.edit.title');
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
                ->modalHeading(__('app/employee-resource.actions.modals.delete.single.heading'))
                ->modalDescription(__('app/employee-resource.actions.modals.delete.single.description'))
                ->hidden(fn (Employee $record): bool => $record->user->hasRole(Role::SUPER_ADMIN) || $record->deleted_at),
            Actions\ForceDeleteAction::make()
                ->modalHeading(__('app/employee-resource.actions.modals.force_delete.single.heading'))
                ->modalDescription(__('app/employee-resource.actions.modals.force_delete.single.description'))
                ->hidden(fn (Employee $record): bool => $record->user->hasRole(Role::SUPER_ADMIN)),
            Actions\RestoreAction::make()
                ->modalHeading(__('app/employee-resource.actions.modals.restore.single.heading'))
                ->modalDescription(__('app/employee-resource.actions.modals.restore.single.description'))
                ->hidden(fn (Employee $record): bool => $record->user->hasRole(Role::SUPER_ADMIN)),
        ];
    }

    #[Override]
    protected function getRedirectUrl(): string
    {
        /** @var string $url */
        $url = $this->getResource()::getUrl('view', ['record' => $this->record]);

        return $url;
    }

    #[Override]
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['avatar']) && $this->record) {
            // Clear the existing avatar collection before adding the new file
            $this->record->clearMediaCollection('avatar');
        }

        return $data;
    }

    #[Override]
    protected function getCancelFormAction(): Actions\Action
    {
        return Action::make('cancel')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
            ->url(static::getResource()::getUrl())
            ->color('gray');
    }
}
