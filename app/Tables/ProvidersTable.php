<?php

namespace App\Tables;

use App\Models\Provider;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class ProvidersTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Provider::class)
            ->rowActions(fn(Provider $providers) => [
                new ShowRowAction(route('providers.show', $providers->id)),
                new EditRowAction(route('providers.edit', $providers)),
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
