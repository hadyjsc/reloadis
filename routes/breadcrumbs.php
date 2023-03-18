<?php

Breadcrumbs::for('/', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::for('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::for('types', function ($breadcrumbs) {
    $breadcrumbs->push('Type', route('types.index'));
});

Breadcrumbs::for('types.create', function ($breadcrumbs) {
    $breadcrumbs->parent('types');
    $breadcrumbs->push('Create', route('.'));
});

Breadcrumbs::for('types.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('types');
    $breadcrumbs->push('Edit', route('types.edit', $model->id));
    $breadcrumbs->push($model->name, route('.'));
});

Breadcrumbs::for('types.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('types');
    $breadcrumbs->push('Show', route('types.show', $model->id));
    $breadcrumbs->push($model->name, route('.'));
});

Breadcrumbs::for('categories', function ($breadcrumbs) {
    $breadcrumbs->push('Category', route('categories.index'));
});

Breadcrumbs::for('create', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Create', route('categories.create'));
});

Breadcrumbs::for('show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push($model->name, route('categories.show', $model->id));
});

Breadcrumbs::for('edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push($model->name, route('categories.edit', $model->id));
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

Breadcrumbs::for('products', function ($bc) {
    $bc->parent('dashboard');
    $bc->push('Product', route('products.index'));
});

Breadcrumbs::for('product-items', function ($bc) {
    $bc->parent('dashboard');
    $bc->push('Product', route('product-items.index'));
});
