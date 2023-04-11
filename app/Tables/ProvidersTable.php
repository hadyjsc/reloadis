<?php

namespace App\Tables;

use App\Models\Provider;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;
use Okipa\LaravelTable\Table;
use Okipa\LaravelTable\Result;
use Illuminate\Database\Query\Builder;

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
            Result::make()
                ->title('Total of data')
                ->format(static fn(Builder $totalRowsQuery) => $totalRowsQuery->count()),
        ];
    }
}
