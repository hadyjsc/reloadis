<?php

Breadcrumbs::for('/', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::for('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::for('types', function ($breadcrumbs) {
    $breadcrumbs->push('Types', route('.'));
});

Breadcrumbs::for('categories', function ($bc) {
    $bc->parent('dashboard');
    $bc->push('Category', route('categories.index'));
});

Breadcrumbs::for('create', function ($bc) {
    $bc->parent('categories');
    $bc->push('Create', route('categories.create'));
});

Breadcrumbs::for('detail', function ($bc, $model) {
    $bc->parent('categories');
    // $bc->push($model->name, route('categories.detail', $model->id));
});

Breadcrumbs::for('sub-categories', function ($breadcrumbs) {
    $breadcrumbs->push('SubCategories', route('.'));
});

Breadcrumbs::for('banks', function ($breadcrumbs) {
    $breadcrumbs->push('Banks', route('.'));
});

Breadcrumbs::for('providers', function ($breadcrumbs) {
    $breadcrumbs->push('Providers', route('.'));
});
