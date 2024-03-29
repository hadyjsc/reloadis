<?php

namespace App\Tables;

use App\Models\Category;
use App\Models\Type;
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
use JscDev\LaravelTable\HeadActions\AddHeadAction;
use JscDev\LaravelTable\HeadActions\CreateHeadAction;

class CategoriesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Category::class)
            ->filters([
                new RelationshipFilter('Types', 'type', Type::pluck('name', 'id')->toArray(), false)
            ])
            ->rowActions(fn(Category $categories) => [
                new ShowRowAction(route('categories.show', $categories->id)),
                new EditRowAction(route('categories.edit', $categories->id)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('type_id')->title('Type')
                ->format(function(Category $cat){
                    return $cat->type->name;
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
