<?php

use Kirby\Cms\App;
use Kirby\Exception\LogicException;

if (version_compare(App::version() ?? '0', '6.0.0-beta', '<')) {
    throw new LogicException('Kirby Plausible requires Kirby 6');
}

App::plugin('johannschopplich/plausible', [
    'areas' => require __DIR__ . '/src/extensions/areas.php',
    'snippets' => [
        'plausible' => __DIR__ . '/src/snippets/plausible.php'
    ],
    'translations' => require __DIR__ . '/src/extensions/translations.php'
]);
