<?php

namespace App\Filament\Resources\PemeriksaanFungsiAlatResource\Pages;

use App\Filament\Resources\PemeriksaanFungsiAlatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemeriksaanFungsiAlat extends EditRecord
{
    protected static string $resource = PemeriksaanFungsiAlatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
