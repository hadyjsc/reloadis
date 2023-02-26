<?php

Breadcrumbs::register('/', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('.'));
});

Breadcrumbs::register('types', function ($breadcrumbs) {
    $breadcrumbs->push('Types', route('.'));
});
