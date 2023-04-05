<?php

\Kirby\Cms\App::plugin('johannschopplich/plausible', [
    'areas' => require __DIR__ . '/src/extensions/areas.php',
    'snippets' => [
        'plausible' => __DIR__ . '/src/snippets/plausible.php'
    ]
]);
