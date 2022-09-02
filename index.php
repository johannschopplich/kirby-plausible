<?php

\Kirby\Cms\App::plugin('johannschopplich/plausible', [
    'areas' => require __DIR__ . '/extensions/areas.php',
    'snippets' => [
        'plausible' => __DIR__ . '/snippets/plausible.php'
    ]
]);
