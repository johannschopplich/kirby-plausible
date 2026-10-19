<?php

use Kirby\Cms\App;

$kirby = App::instance();

if ($kirby->option('debug') === true || $kirby->user() !== null) {
    return;
}

$scriptUrl = $kirby->option('johannschopplich.plausible.scriptUrl');

if (!$scriptUrl) {
    echo js('https://plausible.io/js/plausible.js', [
        'defer' => true,
        'data-domain' => $kirby->option('johannschopplich.plausible.domain') ?? parse_url($kirby->url(), PHP_URL_HOST)
    ]);
    return;
}

?>
<?= js($scriptUrl, ['async' => true]) ?>

<script>
  window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
  plausible.init()
</script>
