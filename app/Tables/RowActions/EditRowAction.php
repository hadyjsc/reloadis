<?php

namespace App\Tables\RowActions;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use JscDev\LaravelTable\Abstracts\AbstractRowAction;

class EditRowAction extends AbstractRowAction
{
    public function __construct(public string $editUrl)
    {
    }

    protected function identifier(): string
    {
        return 'row_action_edit';
    }

    protected function class(Model $model): array
    {
        return ['btn btn-warning btn-icon border-0 rounded-0'];
    }

    protected function icon(Model $model): string
    {
        return config('laravel-table.icon.edit').' Ubah';
    }

    protected function title(Model $model): string
    {
        return __('Edit');
    }

    protected function defaultConfirmationQuestion(Model $model): string|null
    {
        return null;
    }

    protected function defaultFeedbackMessage(Model $model): string|null
    {
        return null;
    }

    public function action(Model $model, Component $livewire): void
    {
        redirect()->to($this->editUrl);
    }
}
