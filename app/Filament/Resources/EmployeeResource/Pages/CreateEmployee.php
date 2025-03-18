<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Enums\Employees\EmployeeStatusEnum;
use App\Enums\GenderEnum;
use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('app/employee-resource.create.title');
    }

    #[Override]
    protected function getRedirectUrl(): string
    {
        /** @var string $url */
        $url = $this->getResource()::getUrl('index');

        return $url;
    }
}
