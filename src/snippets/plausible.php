<?php

use Kirby\Cms\App;

$kirby = App::instance();

$scriptUrl = $kirby->option('johannschopplich.plausible.scriptUrl');

if (!$scriptUrl || $kirby->option('debug') === true || $kirby->user() !== null) {
    return;
}

?>
<?= js($scriptUrl, ['async' => true]) ?>

<script>
  window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
  plausible.init()
</script>
