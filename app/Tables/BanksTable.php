<?php

namespace App\Tables;

use App\Models\Bank;
use JscDev\LaravelTable\Abstracts\AbstractTableConfiguration;
use JscDev\LaravelTable\Column;
use JscDev\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;
use JscDev\LaravelTable\Table;

class BanksTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Bank::class)
            ->rowActions(fn(Bank $banks) => [
                new EditRowAction(route('banks.edit', $banks)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('name')->title('Name')->searchable(),
            Column::make('created_at')->title('Created At')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
            Column::make('updated_at')->title('Updated At')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
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
