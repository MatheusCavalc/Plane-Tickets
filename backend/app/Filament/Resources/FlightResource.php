<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Airport;
use App\Models\Company;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('departure_from')
                    ->label('Departure')
                    ->options(Airport::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('destination')
                    ->label('Destination')
                    ->options(Airport::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('company_id')
                    ->label('Company')
                    ->options(Company::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\DateTimePicker::make('departure_time')
                    ->required(),
                Forms\Components\DateTimePicker::make('arrival_time')
                    ->required(),
                Forms\Components\TextInput::make('available_tickets')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ticket_price')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departure_from')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('destination')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departure_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('arrival_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_tickets')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ticket_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'view' => Pages\ViewFlight::route('/{record}'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
