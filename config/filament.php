<?php

return [
    'default_panel' => 'admin',
    'panels' => [
        'admin' => [
            'path' => 'admin',
            'provider' => App\Providers\Filament\AdminPanelProvider::class,
        ],
    ],
];
