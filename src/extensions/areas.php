<?php

return [
    'plausible' => fn (\Kirby\Cms\App $kirby) => [
        'label' => 'Analytics',
        'icon' => 'chart',
        'disabled' => false,
        'menu' => true,
        'link' => 'plausible',
        'views' => [
            [
                'pattern' => 'plausible',
                'action'  => fn () => [
                    'component' => 'KPlausibleView',
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
