<?php

namespace App\Tables;

use App\Models\Product;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;
use Okipa\LaravelTable\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as BuilderResult;

class TransactionReportTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()
            ->model(Product::class)
            ->query(function(Builder $query) {
                return $query->select(DB::raw('products.id, products.provider_id, products.price, products.fund,
                    COUNT(product_items.id) AS stock,
                    COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS sold,
                    COUNT(product_items.id) - COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS last_stock,
                    (products.price - products.fund) * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS profit'))
                ->join('product_items', 'products.id', '=', 'product_items.product_id')
                ->groupBy(['products.id', 'products.provider_id', 'products.price', 'products.fund'])
                ->orderBy('products.provider_id');
            });
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('id')->sortable(),
            Column::make('provider_id')->title('Provider'),
            Column::make('price')->title('Harga'),
            Column::make('fund')->title('Modal'),
            Column::make('stock')->title('Stok'),
            Column::make('last_stock')->title('Sisa Stok'),
            Column::make('sold')->title('Terjual'),
            Column::make('profit')->title('Keuntungan')->format(function($data) {
                return 'Rp. '.number_format($data['profit'], 0, ',', '.');;
            }),
        ];
    }

    protected function results(): array
    {
        return [
            Result::make()
                ->title('Total profit yang diperoleh')
                ->format(static function(BuilderResult $query) {
                    $query = Product::select(DB::raw('(products.price - products.fund) * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS profit'))
                        ->join('product_items', 'products.id', '=', 'product_items.product_id')
                        ->groupBy(['products.price', 'products.fund'])
                        ->get(['profit']);

                    $sum = 0;
                    foreach ($query as $key => $value) {
                        $sum += $value->profit;
                    }

                    $toIDR = number_format($sum, 0, ',', '.');

                    return 'Rp. '.$toIDR;
                }),
        ];
    }
}
