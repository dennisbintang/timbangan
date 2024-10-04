<?php

namespace App\Filament\Resources\PengaruhPembebananTengahResource\Pages;

use App\Filament\Resources\PengaruhPembebananTengahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaruhPembebananTengah extends EditRecord
{
    protected static string $resource = PengaruhPembebananTengahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
