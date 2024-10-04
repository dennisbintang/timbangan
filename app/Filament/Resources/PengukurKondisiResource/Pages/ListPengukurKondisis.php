<?php

namespace App\Filament\Resources\PengukurKondisiResource\Pages;

use App\Filament\Resources\PengukurKondisiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengukurKondisis extends ListRecords
{
    protected static string $resource = PengukurKondisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
