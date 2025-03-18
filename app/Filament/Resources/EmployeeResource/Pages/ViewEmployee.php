<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employees\EmployeeDocument;
use App\Services\GenerateEmployeeDocumentsService;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;
use Override;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('app/employee-resource.view.title');
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('downloadDocuments')
                ->label(__('app/employee-resource.actions.modals.download_documents.button'))
                ->form([
                    Select::make('employee_documents')
                        ->label(__('app/employee-resource.actions.modals.download_documents.select_documents'))
                        ->options(EmployeeDocument::query()->pluck('name', 'id')->toArray())
                        ->multiple()
                        ->required(),
                ])
                /**
                 * Handle document generation and download.
                 *
                 * @param array{employee_documents: array<int, int>} $data
                 * @return \Symfony\Component\HttpFoundation\StreamedResponse|null
                 * @throws \PhpOffice\PhpWord\Exception\CopyFileException
                 * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
                 * @throws \PhpOffice\PhpWord\Exception\Exception
                 */
                ->action(function (array $data): StreamedResponse|null {
                    /** @var \App\Models\Employees\Employee $employee */
                    $employee = $this->record;
                    $documents = EmployeeDocument::query()
                        ->whereIn('id', $data['employee_documents'])
                        ->get();
                    $service = app(GenerateEmployeeDocumentsService::class);
                    $documentPaths = [];

                    foreach ($documents as $document) {
                        $path = $service->generateDocument($document, $employee->toArray());
                        if ($path !== null) {
                            $documentPaths[] = $path;
                        }
                    }

                    if (empty($documentPaths)) {
                        Notification::make()
                            ->danger()
                            ->title(__('app/employee-resource.actions.modals.download_documents.no_documents_generated'))
                            ->send();
                        return null;
                    }

                    $zipFilePath = $service->createZipFile($employee, $documentPaths);
//                    $this->downloadFile($zipFilePath, basename($zipFilePath));
                    return response()->streamDownload(
                        fn () => readfile($zipFilePath),
                        basename($zipFilePath)
                    );
                }),
        ];
    }
}
