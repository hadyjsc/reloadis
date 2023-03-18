<?php

namespace App\Tables;

use App\Models\Product;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class ProductsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Product::class)
            ->rowActions(fn(Product $product) => [
                new EditRowAction(route('product.edit', $product)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('category_id')->title('Kategori'),
            Column::make('provider_id')->title('Provider'),
            Column::make('quota')->title('Kuota'),
            Column::make('unit')->title('Satuan'),
            Column::make('price')->title('Harga'),
            Column::make('fund')->title('Harga Modal'),
            Column::make('stocked')->title('Tersedia'),
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
