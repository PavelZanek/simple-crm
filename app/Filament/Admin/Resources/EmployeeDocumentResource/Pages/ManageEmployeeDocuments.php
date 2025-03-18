<?php

namespace App\Filament\Admin\Resources\EmployeeDocumentResource\Pages;

use App\Filament\Admin\Resources\EmployeeDocumentResource;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeDocument;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Override;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ManageEmployeeDocuments extends ManageRecords
{
    protected static string $resource = EmployeeDocumentResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('admin/employee-document-resource.list.title');
    }

    public function setPage($page, $pageName = 'page'): void // @phpstan-ignore-line @pest-ignore-type
    {
        parent::setPage($page, $pageName);

        $this->dispatch('scroll-to-top');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalHeading(__('admin/employee-document-resource.create.title'))
                ->mutateFormDataUsing(function (array $data): array {
                    $data['position'] = EmployeeDocument::query()->count() + 1;

                    return $data;
                }),
            Actions\Action::make('availableVariables')
                ->button()
                ->label(__('admin/employee-document-resource.actions.available_variables'))
                ->modalHeading(__('admin/employee-document-resource.actions.modals.available_variables.heading'))
                ->modalContent(fn (): View => view('filament.admin.available-employee-variables', [
                    'tableData' => $this->getAvailableEmployeeVariables(),
                ]))
                ->modalWidth(MaxWidth::FitContent)
                ->modalSubmitAction(false),
            Actions\Action::make('downloadSampleDocx')
                ->button()
                ->label(__('admin/employee-document-resource.actions.download_sample'))
                ->action(function (): BinaryFileResponse {
                    Notification::make()
                        ->success()
                        ->title(__('admin/employee-document-resource.actions.download_sample_success'))
                        ->send();

                    return response()->download(
                        storage_path('initial-templates/test.docx'),
                        'sample-employee-document.docx'
                    );
                }),
        ];
    }


    /**
     * Returns available employee variables for template usage.
     *
     * @return array<int, array{camelCase: string, translation: string}>
     */
    protected function getAvailableEmployeeVariables(): array
    {
        $employeeFillable = (new Employee)->getFillable();

        $toRemove = [
            'user_id',
            'is_created_from_import',
        ];

        $filteredFillable = array_filter(
            $employeeFillable,
            static function (string $item) use($toRemove): bool {
                return !in_array($item, $toRemove, true);
            }
        );

        return array_map(
            static function (string $item): array {
                return [
                    'camelCase'   => Str::camel($item),
                    'translation' => __('app/employee-resource.attributes.' . $item),
                ];
            },
            $filteredFillable
        );
    }
}
