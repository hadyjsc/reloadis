<?php

namespace App\Tables\RowActions;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use JscDev\LaravelTable\Abstracts\AbstractRowAction;

class DestroyRowAction extends AbstractRowAction
{
    protected function identifier(): string
    {
        return 'row_action_destroy';
    }

    protected function class(Model $model): array
    {
        return ['btn btn-danger btn-icon border-0 rounded-0'];
    }

    protected function title(Model $model): string
    {
        return __('Destroy');
    }

    protected function icon(Model $model): string
    {
        return config('laravel-table.icon.destroy').' Hapus';
    }

    protected function defaultConfirmationQuestion(Model $model): string|null
    {
        return __('Are you sure you want to execute the action :action on the line #:primary?', [
            'action' => __('Destroy'),
            'primary' => $model->getKey(),
        ]);
    }

    protected function defaultFeedbackMessage(Model $model): string|null
    {
        return __('The action :action has been executed on the line #:primary.', [
            'action' => __('Destroy'),
            'primary' => $model->getKey(),
        ]);
    }

    /** @return mixed|void */
    public function action(Model $model, Component $livewire)
    {
        $model->delete();
    }
}
