<?php

namespace App\Tables\Filters;

use Illuminate\Database\Eloquent\Builder;
use JscDev\LaravelTable\Abstracts\AbstractDatePicker;

class DatePickerFilter extends AbstractDatePicker
{
    public function __construct(
        public string $label,
        public string $attribute,
        // public array $options,
    )
    {

    }

    protected function identifier(): string
    {
        return 'date_time_filter';
    }

    protected function class(): array
    {
        return [ 'form-control daterange-cus' ];
    }

    protected function attributes(): array
    {
        return [ $this->attribute ];
    }

    protected function label(): string
    {
        return $this->label;
    }

    protected function options(): array
    {
        return [];
    }

    public function filter(Builder $query, mixed $selected): void
    {
        if (is_string($selected)) {
            $selected = explode(" - ", $selected);
            if( count($selected) == 1) {
                $selected['start'] = $selected[0];
                $selected['end'] = $selected[0];
            }else {
                $selected['start'] = $selected[0];
                $selected['end'] = $selected[1];
            }
        }

        if($selected['start'] != "" && $selected['end'] != "") {
            $query->whereDate( $this->attribute, [ $selected['start'], $selected['end'] ]);
        }

    }
}
