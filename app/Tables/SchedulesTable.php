<?php

namespace App\Tables;

use App\Models\Schedule;
use JscDev\LaravelTable\Abstracts\AbstractTableConfiguration;
use JscDev\LaravelTable\Column;
use JscDev\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;
use JscDev\LaravelTable\Table;

class SchedulesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Schedule::class)
            ->rowActions(fn(Schedule $schedule) => [
                new ShowRowAction(route('schedules.show', $schedule)),
                new EditRowAction(route('schedules.edit', $schedule)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('ID')->sortable(),
            Column::make('user_id')->title('Karyawan')
            ->format(function(Schedule $model){
                return $model->user->name;
            }),
            Column::make('branch_id')->title('Cabang')
            ->format(function(Schedule $model){
                return $model->branch->name;
            }),
            Column::make('start_time')->title('Jam Masuk'),
            Column::make('end_time')->title('Jam Berakhir'),
            Column::make('is_active')->title('Status')->format(function(Schedule $model) {
                if ($model->is_active) {
                    return "<span class='badge badge-success'>Online</span>";
                }
                return "<span class='badge badge-danger'>Offline</span>";
            }),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }
}
