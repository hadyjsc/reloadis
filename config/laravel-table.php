<?php

return [

    /**
     * The UI framework that should be used to generate the components.
     * Can be set to:
     * - bootstrap-5
     * - bootstrap-4
     * - tailwind-3 (upcoming feature)
     */
    'ui' => 'bootstrap-4',

    /** Set all the displayed action icons. */
    'icon' => [
        'filter' => '<i class="fas fa-solid fa-filter fa-2x"></i>',
        'rows_number' => '<i class="fas fa-solid fa-list-ol"></i>',
        'sort' => '<i class="fas fa-solid fa-sort fa-fw"></i>',
        'sort_asc' => '<i class="fas fa-solid fa-sort-up fa-fw"></i>',
        'sort_desc' => '<i class="fas fa-solid fa-sort-down fa-fw"></i>',
        'search' => '<i class="fas fa-solid fa-search"></i>',
        'validate' => '<i class="fas fa-solid fa-check"></i>',
        'info' => '<i class="fas fa-solid fa-info-circle"></i>',
        'reset' => '<i class="fas fa-solid fa-undo"></i>',
        'drag_drop' => '<i class="fas fa-solid fa-grip-vertical"></i>',
        'add' => '<i class="fas fa-solid a-plus-circle fa-fw"></i>',
        'create' => '<i class="fas fa-solid fa-plus-circle fa-fw"></i>',
        'show' => '<i class="fas fa-solid fa-eye fa-fw"></i>',
        'edit' => '<i class="fas fa-solid fa-edit fa-fw"></i>',
        'destroy' => '<i class="fas fa-solid fa-trash fa-fw"></i>',
        'active' => '<i class="fas fa-solid fa-check text-success fa-fw"></i>',
        'inactive' => '<i class="fas fa-solid fa-times text-danger fa-fw"></i>',
        'email_verified' => '<i class="fas fa-solid fa-certificate text-info fa-fw"></i>',
        'email_unverified' => '<i class="fas fa-solid fa-envelope fa-fw"></i>',
        'toggle_on' => '<i class="fas fa-solid fa-toggle-on fa-fw"></i>',
        'toggle_off' => '<i class="fas fa-solid fa-toggle-off fa-fw"></i>',
    ],

    /** The default table select HTML components attributes. */
    'html_select_components_attributes' => [],

    /** Whether the select allowing to choose the number of rows per page should be displayed by default. */
    'enable_number_of_rows_per_page_choice' => true,

    /** The default number-of-rows-per-page-select options. */
    'number_of_rows_per_page_default_options' => [10, 25, 50, 75, 100],

];
