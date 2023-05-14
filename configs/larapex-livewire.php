<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | This value sets the root namespace for Livewire component classes in
    | your application. This value affects component auto-discovery and
    | any Livewire file helper commands, like `artisan make:livewire`.
    |
    | After changing this item, run: `php artisan livewire:discover`.
    |
    */

    'class_namespace' => 'App\\Http\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | Script Section
    |--------------------------------------------------------------------------
    |
    | Here you may specify which script section in your blade template,
    | chart scripts need to push.
    |
    */

    'script_section' => '',
    /*
    |--------------------------------------------------------------------------
    | Font Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify font family.
    |
    */

    'font_family' => 'Nunito',

    /*
    |--------------------------------------------------------------------------
    | Default Colors
    |--------------------------------------------------------------------------
    |
    | Here you may specify background color and font color.
    |
    */
    'background_color' => '#ffffff00',

    'font_color' => '#f1f1f1',

    // 'font_color' => '#373d3f',

    /*
    |--------------------------------------------------------------------------
    | Theme Colors for datasets
    |--------------------------------------------------------------------------
    |
    | Here you may specify which hexadecimal colors below you wish
    | to use as your default colors palette in that order.
    |
    */

    'colors' => [
        '#00E396', '#80effe', '#ff6384', '#008FFB',
        '#117f56', '#feb019', '#775dd0', '#ff6384',
        '#80effe', '#0077B5', '#ff455f', '#c9cbcf',
        '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4',
        '#111D5E', '#B21F66', '#FE346E', '#FFBD69',
        '#CFF1EF', '#FFFFFF', '#FBCFFC', '#BE79DF',
        "#f72585", "#b5179e", "#7209b7", "#560bad", "#480ca8", "#3a0ca3", "#3f37c9", "#4361ee", "#4895ef", "#4cc9f0",
        "#001219", "#005f73", "#0a9396", "#94d2bd", "#e9d8a6", "#ee9b00", "#ca6702", "#bb3e03", "#ae2012", "#9b2226",
        "#7400b8", "#6930c3", "#5e60ce", "#5390d9", "#4ea8de", "#48bfe3", "#56cfe1", "#64dfdf", "#72efdd", "#80ffdb",
    ]
];
