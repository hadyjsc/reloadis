<?php

namespace App\Tables;

use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\Filters\RelationshipFilter;
use Okipa\LaravelTable\Table;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;

class ProductsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Product::class)
            ->filters([
                new RelationshipFilter('Category', 'type', Category::pluck('name', 'id')->toArray(), false),
                new RelationshipFilter('Provider', 'type', Provider::pluck('name', 'id')->toArray(), false),
            ])
            ->rowActions(fn(Product $product) => [
                new ShowRowAction(route('products.show', $product)),
                new EditRowAction(route('products.edit', $product)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('category_id')->title('Category')
                ->format(function(Product $model){
                    return $model->category->name;
                }),
            Column::make('provider_id')->title('Provider')
            ->format(function(Product $model){
                return $model->provider->name;
            }),
            Column::make('quota')->title('Kuota')->searchable(),
            Column::make('unit')->title('Satuan'),
            Column::make('price')->title('Harga')->format(function(Product $model) {
                $toIDR = number_format($model->price, 0, ',', '.');
                return 'Rp. '.$toIDR;
            })->searchable(),
            Column::make('fund')->title('Harga Modal')->format(function(Product $model) {
                $toIDR = number_format($model->fund, 0, ',', '.');
                return 'Rp. '.$toIDR;
            }),
            Column::make('stocked')->title('Tersedia')->format(function(Product $model) {
                if ($model->stocked) {
                    return "<span class='badge badge-success'>Tersedia</span>";
                }
                return "<span class='badge badge-danger'>Habis</span>";

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
