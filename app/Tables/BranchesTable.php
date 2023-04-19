<?php

namespace App\Tables;

use App\Models\Branch;
use JscDev\LaravelTable\Abstracts\AbstractTableConfiguration;
use JscDev\LaravelTable\Column;
use JscDev\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\DestroyRowAction;
use JscDev\LaravelTable\Table;

class BranchesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Branch::class)
            ->rowActions(fn(Branch $branch) => [
                new EditRowAction(route('branches.edit', $branch)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('ID')->sortable(),
            Column::make('name')->title('Name'),
            Column::make('location')->title('Location'),
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
