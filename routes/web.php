<?php

declare(strict_types=1);

use App\Models\Employees\EmployeeDocument;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/employee-document/{id}/download', function (int $id) {
    $document = EmployeeDocument::findOrFail($id);
    $filePath = $document->getFirstMediaPath('document');
    return response()->download($filePath);
})->name('employee-document.download');
