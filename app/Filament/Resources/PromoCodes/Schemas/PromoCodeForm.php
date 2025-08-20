<?php

namespace App\Filament\Resources\PromoCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class PromoCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                Select::make('discount_type')
                    ->required()
                    ->options([
                        'fixed' => 'Fixed',
                        'percentage' => 'Percentage',
                    ]),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                DateTimePicker::make('valid_until')
                    ->required(),
                Toggle::make('is_used')
                    ->required()
            ]);
    }
}
