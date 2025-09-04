<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Umum')->schema([TextInput::make('code'), Select::make('flight_id')->relationship('flight', 'flight_number'), Select::make('flight_class_id')->relationship('class', 'class_type')])->columnSpan(2),
            Section::make('Informasi Penumpang')->schema([
                TextInput::make('number_of_passengers'),
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('phone'),
                Section::make('Daftar Penumpang')->schema([
                    Repeater::make('passenger')
                        ->relationship('passengers')
                        ->schema([
                           Select::make('flight_seat_id')
                            ->label('Seat Name')
                            ->relationship('seat', 'name')
                            ->required(),
                           TextInput::make('name'),
                           TextInput::make('date_of_birth'),
                           TextInput::make('nationality'),
                        ]),
                ]),
            ])->columnSpan(2),
            Section::make('Pembayaran')->schema([
                Select::make('promo_code_id')
                    ->relationship('promo', 'code'),
                TextInput::make('payment_status'),
                TextInput::make('subtotal'),
                TextInput::make('grandtotal')
            ])->columnSpan(2)
        ]);
    }
}
