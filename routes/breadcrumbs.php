<?php

Breadcrumbs::for('/', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::for('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::for('dashboard.product', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard Product', route('.'));
});

Breadcrumbs::for('dashboard.counter', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard Counter', route('dashboard.counter'));
});

Breadcrumbs::for('providers', function ($breadcrumbs) {
    $breadcrumbs->push('Provider', route('providers.index'));
});

Breadcrumbs::for('providers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('providers');
    $breadcrumbs->push('Create', route('.'));
});

Breadcrumbs::for('providers.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('providers');
    $breadcrumbs->push('Edit', route('providers.edit', $model->id));
    $breadcrumbs->push($model->name, route('.'));
});

Breadcrumbs::for('providers.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('providers');
    $breadcrumbs->push('Show', route('providers.show', $model->id));
    $breadcrumbs->push($model->name, route('.'));
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

Breadcrumbs::for('categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Create', route('categories.create'));
});

Breadcrumbs::for('categories.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Edit', route('categories.edit', $model->id));
    $breadcrumbs->push($model->name, route('categories.edit', $model->id));
});

Breadcrumbs::for('categories.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Show', route('categories.show', $model->id));
    $breadcrumbs->push($model->name, route('categories.show', $model->id));
});

Breadcrumbs::for('sub-categories', function ($breadcrumbs) {
    $breadcrumbs->push('Sub Categories', route('sub-categories.index'));
});

Breadcrumbs::for('sub-categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('sub-categories');
    $breadcrumbs->push('Create', route('sub-categories.create'));
});

Breadcrumbs::for('sub-categories.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('sub-categories');
    $breadcrumbs->push('Edit', route('sub-categories.edit', $model->id));
    $breadcrumbs->push($model->name, route('sub-categories.edit', $model->id));
});

Breadcrumbs::for('sub-categories.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('sub-categories');
    $breadcrumbs->push('Show', route('sub-categories.show', $model->id));
    $breadcrumbs->push($model->name, route('sub-categories.show', $model->id));
});

Breadcrumbs::for('banks', function ($breadcrumbs) {
    $breadcrumbs->push('Banks', route('.'));
});

Breadcrumbs::for('banks.create', function ($breadcrumbs) {
    $breadcrumbs->parent('banks');
    $breadcrumbs->push('Create', route('banks.create'));
});

Breadcrumbs::for('banks.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('banks');
    $breadcrumbs->push('Edit', route('banks.edit', $model->id));
    $breadcrumbs->push($model->name, route('banks.edit', $model->id));
});

Breadcrumbs::for('banks.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('banks');
    $breadcrumbs->push('Show', route('banks.show', $model->id));
    $breadcrumbs->push($model->name, route('banks.show', $model->id));
});

Breadcrumbs::for('products', function ($breadcrumbs) {
    $breadcrumbs->push('Product', route('products.index'));
});

Breadcrumbs::for('products.create', function ($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Create', route('products.create'));
});

Breadcrumbs::for('products.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Edit', route('products.edit', $model->id));
    $breadcrumbs->push($model->name, route('products.edit', $model->id));
});

Breadcrumbs::for('products.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Show', route('products.show', $model->id));
    $breadcrumbs->push($model->name, route('products.show', $model->id));
});

Breadcrumbs::for('product-items', function ($breadcrumbs) {
    $breadcrumbs->push('Product Item', route('product-items.index'));
});

Breadcrumbs::for('product-items.create', function ($breadcrumbs) {
    $breadcrumbs->parent('product-items');
    $breadcrumbs->push('Create', route('product-items.create'));
});

Breadcrumbs::for('product-items.edit', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('product-items');
    $breadcrumbs->push('Edit', route('product-items.edit', $model->id));
    $breadcrumbs->push($model->name, route('product-items.edit', $model->id));
});

Breadcrumbs::for('product-items.show', function ($breadcrumbs, $model) {
    $breadcrumbs->parent('product-items');
    $breadcrumbs->push('Show', route('product-items.show', $model->id));
    $breadcrumbs->push($model->name, route('product-items.show', $model->id));
});

Breadcrumbs::for('transactions.selling',function ($breadcrumbs) {
    $breadcrumbs->push('Transaction', route('transactions.selling'));
});

Breadcrumbs::for('users.index',function ($breadcrumbs) {
    $breadcrumbs->push('Karyawan', route('users.index'));
});

Breadcrumbs::for('users.create',function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Create', route('users.create'));
});

Breadcrumbs::for('users.edit',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Edit', route('users.edit', $model->id));
    $breadcrumbs->push($model->name, route('users.edit', $model->id));
});

Breadcrumbs::for('permissions.index',function ($breadcrumbs) {
    $breadcrumbs->push('Permission', route('permissions.index'));
});

Breadcrumbs::for('permissions.create',function ($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Create', route('permissions.create'));
});

Breadcrumbs::for('permissions.edit',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Edit', route('permissions.edit', $model->id));
    $breadcrumbs->push($model->name, route('permissions.edit', $model->id));
});

Breadcrumbs::for('roles.index',function ($breadcrumbs) {
    $breadcrumbs->push('Role', route('roles.index'));
});

Breadcrumbs::for('roles.create',function ($breadcrumbs) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push('Create', route('roles.create'));
});

Breadcrumbs::for('roles.edit',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push('Edit', route('roles.edit', $model->id));
    $breadcrumbs->push($model->name, route('roles.edit', $model->id));
});

Breadcrumbs::for('roles.show',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push('Show', route('roles.show', $model->id));
    $breadcrumbs->push($model->name, route('roles.show', $model->id));
});

Breadcrumbs::for('branches.index',function ($breadcrumbs) {
    $breadcrumbs->push('Branch', route('branches.index'));
});

Breadcrumbs::for('branches.create',function ($breadcrumbs) {
    $breadcrumbs->parent('branches.index');
    $breadcrumbs->push('Create', route('branches.create'));
});

Breadcrumbs::for('branches.edit',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('branches.index');
    $breadcrumbs->push('Edit', route('branches.edit', $model->id));
    $breadcrumbs->push($model->name, route('branches.edit', $model->id));
});

Breadcrumbs::for('branches.show',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('branches.index');
    $breadcrumbs->push('Show', route('branches.show', $model->id));
    $breadcrumbs->push($model->name, route('branches.show', $model->id));
});

Breadcrumbs::for('schedules.index',function ($breadcrumbs) {
    $breadcrumbs->push('Schedule', route('schedules.index'));
});

Breadcrumbs::for('schedules.create',function ($breadcrumbs) {
    $breadcrumbs->parent('schedules.index');
    $breadcrumbs->push('Create', route('schedules.create'));
});

Breadcrumbs::for('schedules.edit',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('schedules.index');
    $breadcrumbs->push('Edit', route('schedules.edit', $model->id));
    $breadcrumbs->push($model->user->name, route('schedules.edit', $model->id));
});

Breadcrumbs::for('schedules.show',function ($breadcrumbs, $model) {
    $breadcrumbs->parent('schedules.index');
    $breadcrumbs->push('Show', route('schedules.show', $model->id));
    $breadcrumbs->push($model->user->name, route('schedules.show', $model->id));
});
