<?php

namespace App\Tables;

use App\Models\ProductItem;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class ProductItemsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(ProductItem::class)
            ->rowActions(fn(ProductItem $productItem) => [
                new EditRowAction(route('productItem.edit', $productItem)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable(),
            Column::make('created_at')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
            Column::make('updated_at')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc'),
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
