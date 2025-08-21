<?php

namespace App\Filament\Resources\Flights\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DateTimePicker;

class FlightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Flight Information')
                        ->schema([
                            TextInput::make('flight_number')
                                ->required()
                                ->unique(ignoreRecord: true),
                            Select::make('airline_id')
                                ->relationship('airline', 'code')
                                ->required(),
                        ]),
                    Step::make('Flight Segment')
                        ->schema([
                            Repeater::make('flight_segments')
                                ->relationship('segments')
                                ->schema([
                                    TextInput::make('sequence')
                                        ->numeric()
                                        ->required(),
                                    Select::make('airport_id')
                                        ->relationship('airport', 'name')
                                        ->required(),
                                    DateTimePicker::make('time')
                                        ->required()
                                ]),
                        ]),
                    Step::make('Flight Class')
                        ->schema([
                            Repeater::make('flight_classes')
                                ->relationship('classes')
                                ->schema([
                                    Select::make('class_type')
                                        ->options([
                                            'economy' => 'Economy',
                                            'business' => 'Business'
                                        ])
                                        ->required(),
                                    TextInput::make('price')
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->minValue(0)
                                        ->required(),
                                    TextInput::make('total_seats')
                                        ->required()
                                        ->numeric()
                                        ->minValue(1)
                                        ->label('Total Seats'),
                                    Select::make('facilities')
                                            ->relationship('facilities', 'name')
                                            ->multiple()
                                            ->required()
                                ]),
                        ]),
                ])->columnSpan(2)
            ]);
    }
}
