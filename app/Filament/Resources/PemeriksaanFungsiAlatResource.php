<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemeriksaanFungsiAlatResource\Pages;
use App\Filament\Resources\PemeriksaanFungsiAlatResource\RelationManagers;
use App\Models\PemeriksaanFungsiAlat;
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

class PemeriksaanFungsiAlatResource extends Resource
{
    protected static ?string $model = PemeriksaanFungsiAlat::class;

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
                    TextInput::make('bagian_alat')->required(),
                    TextInput::make('fisik')->required(),
                    TextInput::make('fungsi')->required()
                ])
                ->columns(2)
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bagian_alat')->searchable(),
                TextColumn::make('fisik')->searchable(),
                TextColumn::make('fungsi')->searchable(),
                //
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
            'index' => Pages\ListPemeriksaanFungsiAlats::route('/'),
            'create' => Pages\CreatePemeriksaanFungsiAlat::route('/create'),
            'edit' => Pages\EditPemeriksaanFungsiAlat::route('/{record}/edit'),
        ];
    }
}
