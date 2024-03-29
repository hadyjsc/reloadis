<?php

namespace App\Tables;

use App\Models\SubCategory;
use App\Models\Category;
use JscDev\LaravelTable\Abstracts\AbstractTableConfiguration;
use JscDev\LaravelTable\Column;
use JscDev\LaravelTable\Formatters\DateFormatter;
use App\Tables\RowActions\EditRowAction;
use App\Tables\RowActions\ShowRowAction;
use App\Tables\RowActions\DestroyRowAction;
use JscDev\LaravelTable\Filters\RelationshipFilter;
use JscDev\LaravelTable\Table;
use JscDev\LaravelTable\Result;
use Illuminate\Database\Query\Builder;

class SubCategoriesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(SubCategory::class)
            ->filters([
                new RelationshipFilter('Categories', 'categories', Category::pluck('name', 'id')->toArray(), false)
            ])
            ->rowActions(fn(SubCategory $subCategories) => [
                new ShowRowAction(route('sub-categories.show', $subCategories->id)),
                new EditRowAction(route('sub-categories.edit', $subCategories)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('category_id')->title('Category')->format(function(SubCategory $model){
                return $model->category->name;
            }),
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
