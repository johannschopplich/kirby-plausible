# Kirby Plausible

> ℹ️ This is a refactored version of [floriankarsten/kirby-plausible](https://github.com/floriankarsten/kirby-plausible).

Integrate a [Plausible](https://plausible.io) analytics dashboard directly into your Kirby Panel.

## Key Features

- ⚡️ `.env` support with [kirby-extended](https://github.com/johannschopplich/kirby-extended)

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-plausible`.

### Git submodule

```bash
git submodule add https://github.com/johannschopplich/kirby-plausible.git site/plugins/kirby-plausible
```

### Composer

```bash
composer require johannschopplich/kirby-plausible
```

## Usage

1. Create a [Plausible shared link](https://plausible.io/docs/shared-links)
2. Set the `johannschopplich.plausible.sharedLink` in your `config.php`

```php
// config.php
return [
  'johannschopplich.plausible' => [
    'sharedLink' => '<your-plausible-shared-link>',
    // Only needed if the frontend URL differs from the index URL of the Kirby instance
    'domain' => '<your-frontend-domain>'
  ]
];
```

### Dotenv Support

Set the `PLAUSIBLE_SHARED_LINK` environment variable optionally instead of the `config.php` option.

### Frontend Snippet

You can use the included snippet. Add it to the `<head>` tag preferably. The script will not be injected in debug mode.

```php
<?php snippet('plausible') ?>
```

## License

[MIT](./LICENSE) License © 2022 [Johann Schopplich](https://github.com/johannschopplich)

[MIT](./LICENSE) License © 2021 [Florian Karsten](https://github.com/floriankarsten)
