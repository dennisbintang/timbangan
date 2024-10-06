<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdministrasiResource\Pages;
use App\Filament\Resources\AdministrasiResource\RelationManagers;
use App\Models\Administrasi;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use App\Models\DaftarAlat;


class AdministrasiResource extends Resource
{
    protected static ?string $model = Administrasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('no_order')->required(),
                        TextInput::make('nama_alat')->required(),
                        TextInput::make('merek')->required(),
                        TextInput::make('model_type')->required(),
                        TextInput::make('no_seri')->required(),
                        TextInput::make('resolusi')->required(),
                        TextInput::make('rentang_ukur')->required(),
                        TextInput::make('nama_instansi')->required(),
                        TextInput::make('ruang_kalibrasi')->required(),
                        DatePicker::make('tanggal_kalibrasi')->required()
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_order'),
                TextColumn::make('nama_alat')->searchable(),
                TextColumn::make('merek')->searchable(),
                // TextColumn::make('model_type')->searchable(),
                // TextColumn::make('no_seri')->searchable(),
                // TextColumn::make('resolusi')->searchable(),
                // TextColumn::make('rentang_ukur')->searchable(),
                TextColumn::make('nama_instansi')->searchable(),
                TextColumn::make('ruang_kalibrasi'),
                TextColumn::make('tanggal_kalibrasi')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Download Report')
                ->url(fn (Administrasi $record): string => route('administrasi.export', $record))
                ->openUrlInNewTab()
                ->icon('heroicon-o-arrow-down-tray'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                // ExportAction::make()->exports([
                //     ExcelExport::make('daftar_alats')->fromTable()
                //     //ExcelExport::make()->fromTable(),
                //     // ExcelExport::make()
                //     // ->withColumns([
                //     //     Column::make('LAPORAN PENGUJIAN DAN/ATAU KALIBRASI TIMBANGAN BAYI'),
                //     // ])
                // ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdministrasis::route('/'),
            'create' => Pages\CreateAdministrasi::route('/create'),
            'edit' => Pages\EditAdministrasi::route('/{record}/edit'),
        ];
    }

    
}
