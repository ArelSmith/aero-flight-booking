<?php

namespace App\Filament\Resources\Flights\Tables;

use App\Models\Flight;
use DateTime;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FlightsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('flight_number'),
                TextColumn::make('airline.name'),
                TextColumn::make('segments')
                    ->label('Route & Duration')
                    ->formatStateUsing(function (Flight $record): string {
                        $firstSegment = $record->segments->first();
                        $lastSegment = $record->segments->last();
                
                        $route = $firstSegment->airport->iata_code . ' to ' . $lastSegment->airport->iata_code;
                        $duration = (new DateTime($firstSegment->time))->format('d F Y H:i') . ' - ' . (new DateTime($lastSegment->time))->format('d F Y H:i');
 
                        return $route . ' | ' . $duration ;
                    })
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
