<?php

namespace App\Filament\Resources\PengukurKondisiResource\Pages;

use App\Filament\Resources\PengukurKondisiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengukurKondisi extends EditRecord
{
    protected static string $resource = PengukurKondisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
