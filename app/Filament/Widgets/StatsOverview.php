<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $openJobs = Job::query()->whereIn('status', ['quoted', 'scheduled', 'in_progress'])->count();
        $revenue = (float) Invoice::query()->where('status', 'paid')->sum('total');
        $upcoming = Appointment::query()->where('starts_at', '>=', now())->where('status', '!=', 'cancelled')->count();

        return [
            Stat::make('Active Projects', (string) $openJobs)
                ->description('Quoted, scheduled, or in progress')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),
            Stat::make('Customers', (string) Customer::query()->count())
                ->description('Homeowners on file')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('Paid Revenue', '$'.number_format($revenue, 0))
                ->description('Collected invoice totals')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),
            Stat::make('Upcoming Appointments', (string) $upcoming)
                ->description('Consults & site walks')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
        ];
    }
}
