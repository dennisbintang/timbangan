<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KemampuanBacaKembaliResource\Pages;
use App\Filament\Resources\KemampuanBacaKembaliResource\RelationManagers;
use App\Models\KemampuanBacaKembali;
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

class KemampuanBacaKembaliResource extends Resource
{
    protected static ?string $model = KemampuanBacaKembali::class;

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
                    TextInput::make('KMN_nol')->required(),
                    TextInput::make('KMN_pembaca')->required(),
                    TextInput::make('KS_nol')->required(),
                    TextInput::make('KS_pembaca')->required(),
                    TextInput::make('KP_nol')->required(),
                    TextInput::make('KP_pembaca')->required()
                ])
                ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('KMN_nol')->label('KMN Nol (zi)')->searchable(),
                TextColumn::make('KMN_pembaca')->label('KMN Pembacaan (mi)')->searchable(),
                TextColumn::make('KS_nol')->label('KS Nol (zi)')->searchable(),
                TextColumn::make('KS_pembaca')->label('KS (mi)')->searchable(),
                TextColumn::make('KP_nol')->label('KP Nol (zi)')->searchable(),
                TextColumn::make('KP_pembaca')->label('KP Pembacaan (mi)')->searchable()
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
            'index' => Pages\ListKemampuanBacaKembalis::route('/'),
            'create' => Pages\CreateKemampuanBacaKembali::route('/create'),
            'edit' => Pages\EditKemampuanBacaKembali::route('/{record}/edit'),
        ];
    }
}
