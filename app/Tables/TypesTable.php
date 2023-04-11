<?php

namespace App\Tables;

use App\Models\Type;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;
use Okipa\LaravelTable\Table;
use Okipa\LaravelTable\Result;
use Illuminate\Database\Query\Builder;

class TypesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Type::class)
            ->rowActions(fn(Type $type) => [
                new ShowRowAction(route('types.show', $type->id)),
                new EditRowAction(route('types.edit', $type->id)),
                new DestroyRowAction(),
            ])
            ->numberOfRowsPerPageOptions([10, 50, 100]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable()->title('Id'),
            Column::make('name')->title('Name')->searchable(),
            Column::make('created_at')->title('Created At')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
            Column::make('updated_at')->title('Updated At')->format(new DateFormatter('d/m/Y H:i'))
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
