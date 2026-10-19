<?php

use Kirby\Cms\App;

App::plugin('johannschopplich/plausible', [
    'areas' => require __DIR__ . '/src/extensions/areas.php',
    'snippets' => [
        'plausible' => __DIR__ . '/src/snippets/plausible.php'
    ],
    'translations' => require __DIR__ . '/src/extensions/translations.php'
]);
