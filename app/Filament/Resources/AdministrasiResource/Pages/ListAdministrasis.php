<?php

namespace App\Filament\Resources\AdministrasiResource\Pages;

use App\Filament\Resources\AdministrasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListAdministrasis extends ListRecords
{
    protected static string $resource = AdministrasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // ExportAction::make() 
            // ->exports([
            //     ExcelExport::make()
            //         ->withFilename('Report -' . date('Y-m-d') . '.xls')
            //         ->withColumns([
            //             Column::make('LAPORAN PENGUJIAN DAN/ATAU KALIBRASI TIMBANGAN BAYI'),
            //             Column::make('no_order'),
            //         ])
            // ]), 
        ];
    }
}
