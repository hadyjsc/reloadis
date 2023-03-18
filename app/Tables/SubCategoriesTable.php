<?php

namespace App\Tables;

use App\Models\SubCategory;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Filters\RelationshipFilter;
use Okipa\LaravelTable\Table;

class SubCategoriesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(SubCategory::class)
            ->filters([
                new RelationshipFilter('Categories', 'categories', SubCategory::pluck('name', 'id')->toArray(), false)
            ])
            ->rowActions(fn(SubCategory $subCategories) => [
                new ShowRowAction(route('subCategories.show', $subCategories->id)),
                new EditRowAction(route('subCategories.edit', $subCategories)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('Id')->sortable(),
            Column::make('category_id')->title('Category'),
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
        ];
    }
}
