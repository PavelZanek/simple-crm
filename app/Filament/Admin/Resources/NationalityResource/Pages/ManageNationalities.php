<?php

namespace App\Filament\Admin\Resources\NationalityResource\Pages;

use App\Filament\Admin\Resources\NationalityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class ManageNationalities extends ManageRecords
{
    protected static string $resource = NationalityResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('admin/nationality-resource.list.title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalHeading(__('admin/nationality-resource.create.title')),
        ];
    }

    public function setPage($page, $pageName = 'page'): void // @phpstan-ignore-line @pest-ignore-type
    {
        parent::setPage($page, $pageName);

        $this->dispatch('scroll-to-top');
    }
}
