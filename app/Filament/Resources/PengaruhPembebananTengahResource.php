<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaruhPembebananTengahResource\Pages;
use App\Filament\Resources\PengaruhPembebananTengahResource\RelationManagers;
use App\Models\PengaruhPembebananTengah;
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

class PengaruhPembebananTengahResource extends Resource
{
    protected static ?string $model = PengaruhPembebananTengah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
                    TextInput::make('posisi')->required(),
                    TextInput::make('pembacaan')->label('Pembacaan (kg)')->required(),
                ])
                ->columns(2)
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('posisi')->searchable(),
                TextColumn::make('pembacaan')->searchable(),
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
            'index' => Pages\ListPengaruhPembebananTengahs::route('/'),
            'create' => Pages\CreatePengaruhPembebananTengah::route('/create'),
            'edit' => Pages\EditPengaruhPembebananTengah::route('/{record}/edit'),
        ];
    }
}
