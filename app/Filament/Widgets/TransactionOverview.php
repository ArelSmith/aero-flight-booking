<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;

class TransactionOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transactions', Transaction::query()->count()), 
            Stat::make('Total Amount (Pending)', 'Rp' . number_format(Transaction::query()->where('payment_status', 'pending')->sum('grandtotal'), 0, ',', '.'))
                ->color('warning'),
            Stat::make('Total Amount (Paid)', 'Rp' . number_format(Transaction::query()->where('payment_status', 'paid')->sum('grandtotal'), 0, ',', '.'))
                ->color('success'),
        ];
    }
}
