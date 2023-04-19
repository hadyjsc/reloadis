<?php

namespace App\Tables;

use App\Models\ProductItem;
use JscDev\LaravelTable\Abstracts\AbstractTableConfiguration;
use JscDev\LaravelTable\Column;
use JscDev\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;
use JscDev\LaravelTable\Table;

class ProductItemsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(ProductItem::class)
            ->rowActions(fn(ProductItem $productItem) => [
                new EditRowAction(route('product-items.edit', $productItem)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('product_id')->title('Product')->format(function(ProductItem $model){
                return $model->product->category->name.' - '.$model->product->provider->name.' - '.$model->product->quota;
            })->searchable(),
            Column::make('serial_number')->title('Nomor Seri'),
            Column::make('is_sold')->title('Terjual'),
            Column::make('sold_at')->title('Tanggal Terjual'),
            Column::make('sold_by')->title('Di Jual Oleh')
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
