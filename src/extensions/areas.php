<?php

use Kirby\Cms\App;
use Kirby\Toolkit\I18n;

return [
    'plausible' => fn (App $kirby) => [
        'label' => I18n::translate('johannschopplich.plausible.label'),
        'icon' => 'chart',
        'menu' => true,
        'views' => [
            [
                'pattern' => 'plausible',
                'action' => fn () => [
                    'component' => 'k-plausible-view',
                    'props' => [
                        'sharedLink' => $kirby->option('johannschopplich.plausible.sharedLink', '')
                    ]
                ]
            ]
        ]
    ]
];
