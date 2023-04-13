<?php

namespace App\Tables\Filters;

use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Abstracts\AbstractFilter;

class DateTimeFilter extends AbstractFilter
{
    protected function identifier(): string
    {
        return 'date_time_filter';
    }

    protected function class(): array
    {
        return [
            // The CSS class that will be merged to the existent ones on the filter select.
            // As class are optional on filters, you may delete this method if you don't declare any specific class.
            // Note: you can use conditional class merging as specified here: https://laravel.com/docs/blade#conditionally-merge-classes
            'form-control daterange-cus'
        ];
    }

    protected function attributes(): array
    {
        return [
            // The HTML attributes that will be merged to the existent ones on the filter select.
            // As attributes are optional on filters, you may delete this method if you do declare any specific attributes.
            ...parent::attributes(),
        ];
    }

    protected function label(): string
    {
        return 'Date';
    }

    protected function multiple(): bool
    {
        return false;
    }

    protected function options(): array
    {
        return [now()];
    }

    public function filter(Builder $query, mixed $selected): void
    {
        // The filtering treatment that will be executed on option selection.
        // The $selected attribute will provide an array in multiple mode and a value in single mode.
    }
}
