<?php

namespace App\Filament\Resources\PenyimpanganNilaiNominalResource\Pages;

use App\Filament\Resources\PenyimpanganNilaiNominalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyimpanganNilaiNominals extends ListRecords
{
    protected static string $resource = PenyimpanganNilaiNominalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
