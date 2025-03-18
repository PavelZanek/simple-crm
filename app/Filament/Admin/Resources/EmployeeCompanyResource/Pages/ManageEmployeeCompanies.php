<?php

namespace App\Filament\Admin\Resources\EmployeeCompanyResource\Pages;

use App\Filament\Admin\Resources\EmployeeCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class ManageEmployeeCompanies extends ManageRecords
{
    protected static string $resource = EmployeeCompanyResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('admin/employee-company-resource.list.title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalHeading(__('admin/employee-company-resource.create.title')),
        ];
    }

    public function setPage($page, $pageName = 'page'): void // @phpstan-ignore-line @pest-ignore-type
    {
        parent::setPage($page, $pageName);

        $this->dispatch('scroll-to-top');
    }
}
