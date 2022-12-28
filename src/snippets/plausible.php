<?php if ($kirby->option('debug') === false && $kirby->user() === null): ?>
  <script defer data-domain="<?= $kirby->option('johannschopplich.plausible.domain', parse_url($kirby->url())['host']) ?>" src="https://plausible.io/js/plausible.js"></script>
<?php endif ?>
