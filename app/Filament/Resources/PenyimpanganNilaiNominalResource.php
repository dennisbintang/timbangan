<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenyimpanganNilaiNominalResource\Pages;
use App\Filament\Resources\PenyimpanganNilaiNominalResource\RelationManagers;
use App\Models\PenyimpanganNilaiNominal;
use Filament\Forms;
use App\Models\Administrasi;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenyimpanganNilaiNominalResource extends Resource
{
    protected static ?string $model = PenyimpanganNilaiNominal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Select::make('administrasi_id')
                    ->label('Nomor Order')
                    ->options(Administrasi::all()->pluck('no_order', 'id'))
                    ->searchable()->required(),
                ])
                ->columns(1),
                Card::make()
                ->schema([
                    TextInput::make('nominal_mass')->required(),
                    TextInput::make('z1')->required(),
                    TextInput::make('m1')->required(),
                    TextInput::make('m1_')->label("M1'")->required(),
                ])
                ->columns(2)
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('nominal_mass')->searchable(),
                TextColumn::make('z1')->searchable(),
                TextColumn::make('m1')->searchable(),
                TextColumn::make('m1_')->label("M1'")->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPenyimpanganNilaiNominals::route('/'),
            'create' => Pages\CreatePenyimpanganNilaiNominal::route('/create'),
            'edit' => Pages\EditPenyimpanganNilaiNominal::route('/{record}/edit'),
        ];
    }
}
