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
                return $query->select(DB::raw('products.id, products.provider_id, providers.name, providers.color, products.price, products.fund,
                    COUNT(product_items.id) AS stock,
                    COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS sold,
                    COUNT(product_items.id) - COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS last_stock,
                    (products.price - products.fund) * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS profit'))
                ->join('product_items', 'products.id', '=', 'product_items.product_id')
                ->join('providers', 'products.provider_id', '=', 'providers.id')
                ->groupBy(['products.id', 'products.provider_id', 'products.price', 'products.fund'])
                ->orderBy('products.provider_id');
            });
    }

    protected function columns(): array
    {
        return [
            Column::make('name')->title('Provider')->format(function($data) {
                return '<strong style="color:'.$data['color'].'">'.$data['name'].'</strong>';
            } ),
            Column::make('price')->title('Harga')->format(function($data) {
                return 'Rp. '.number_format($data['price'], 0, ',', '.');;
            }),
            Column::make('fund')->title('Modal')->format(function($data) {
                return 'Rp. '.number_format($data['fund'], 0, ',', '.');;
            }),
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
                ->title('Total terjual')
                ->format(static function(BuilderResult $query) {
                    $query = Product::select(DB::raw('products.id, products.price,
                        COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS sold,
                        (products.price * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END)) AS total_sold'))
                        ->leftjoin('product_items', 'products.id', '=', 'product_items.product_id')
                        ->groupBy(['products.price', 'products.id'])
                        ->get(['id', 'sold','total_sold', 'price']);

                    $sum = 0;
                    foreach ($query as $key => $value) {
                        $sum += $value->total_sold;
                    }

                    $toIDR = number_format($sum, 0, ',', '.');

                    return 'Rp. '.$toIDR;
            }),
            Result::make()
                ->title('Total Modal')
                ->format(static function(BuilderResult $query) {
                    $query = Product::select(DB::raw('products.id, products.fund, COUNT(product_items.id) AS stock, (products.fund * COUNT(product_items.id)) AS total_fund'))
                        ->leftjoin('product_items', 'products.id', '=', 'product_items.product_id')
                        ->groupBy(['products.fund', 'products.id'])
                        ->get(['id', 'fund','stock', 'total_fund']);

                    $sum = 0;
                    foreach ($query as $key => $value) {
                        $sum += $value->total_fund;
                    }

                    $toIDR = number_format($sum, 0, ',', '.');

                    return 'Rp. '.$toIDR;
            }),
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