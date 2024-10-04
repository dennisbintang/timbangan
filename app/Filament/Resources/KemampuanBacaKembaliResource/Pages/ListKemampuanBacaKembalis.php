<?php

namespace App\Filament\Resources\KemampuanBacaKembaliResource\Pages;

use App\Filament\Resources\KemampuanBacaKembaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKemampuanBacaKembalis extends ListRecords
{
    protected static string $resource = KemampuanBacaKembaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
