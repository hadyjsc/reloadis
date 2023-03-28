<?php

namespace App\Tables;

use Spatie\Permission\Models\Permission;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class PermissionsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Permission::class)
            ->rowActions(fn(Permission $model) => [
                new EditRowAction(route('permissions.edit', $model)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('name')->title('Name'),
            Column::make('guard_name')->title('Guard'),
            Column::make('created_at')->title('Created')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
            Column::make('updated_at')->title('Updated')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
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
