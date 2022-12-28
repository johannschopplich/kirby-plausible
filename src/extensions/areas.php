<?php

return [
    'plausible' => fn ($kirby) => [
        'label' => 'Analytics',
        'icon' => 'chart',
        'disabled' => false,
        'menu' => true,
        'link' => 'plausible',
        'views' => [
            [
                'pattern' => 'plausible',
                'action'  => fn () => [
                    'component' => 'k-plausible-view',
                    'title' => 'Analytics',
                    'props' => [
                        'sharedLink' => $kirby->option(
                            'johannschopplich.plausible.sharedLink',
                            function_exists('env') ? env('PLAUSIBLE_SHARED_LINK', '') : ''
                        )
                    ]
                ]
            ]
        ]
    ]
];
