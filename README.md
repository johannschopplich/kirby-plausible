<div align="center">
  <img src="./.github/favicon.svg" alt="Kirby Plausible logo" width="120">

# Kirby Plausible

Kirby Plausible is a plugin for [Kirby CMS](https://getkirby.com) that shows your [Plausible](https://plausible.io) dashboard in the Panel and adds the tracking script to your site.

[Features](#features) •
[Options](#options) •
[Troubleshooting](#troubleshooting)

</div>

## When to Use

| I want to…                                | Use                           |
| ----------------------------------------- | ----------------------------- |
| See my site's stats in the Panel          | `sharedLink` option           |
| Track the visitors of my site             | `snippet('plausible')`        |
| Load Plausible's current tracking script  | `scriptUrl` option            |
| Hide the dashboard from a role            | `access.plausible` permission |
| Report a domain other than my site's host | `domain` option               |

## Features

### 📊 Panel Dashboard

The plugin adds an **Analytics** entry to the Panel menu that embeds your dashboard through a Plausible [shared link](https://plausible.io/docs/shared-links). The dashboard follows the Panel's light or dark theme, lets the Panel's background show through, and grows with its content instead of a fixed height. A shared link from a self-hosted Plausible instance works the same way.

```php
// config.php
return [
    'johannschopplich.plausible' => [
        'sharedLink' => 'https://plausible.io/share/example.com?auth=…'
    ]
];
```

> [!NOTE]
> Plausible can't embed a password-protected shared link. Leave its password empty and control who sees the dashboard through [Panel roles](#-role-access).

### 🏷️ Tracking Snippet

Add the snippet to the `<head>` of your templates. It prints nothing in debug mode or for a logged-in Panel user, so your own visits stay out of the stats.

```php
<?php snippet('plausible') ?>
```

By default, the snippet loads Plausible's legacy `plausible.js` from `plausible.io` and reports the host of your site URL as domain. Plausible gives every site its own script, listed in the site settings under **General → Site installation**. Set its URL as `scriptUrl`, and the snippet prints Plausible's current snippet instead.

To pass options to `plausible.init()`, copy [`src/snippets/plausible.php`](src/snippets/plausible.php) to `site/snippets/plausible.php` and edit the copy: Kirby prefers a site snippet over the plugin's.

### 🔐 Role Access

Kirby gives every Panel area an access permission of its own. Hide the dashboard from a role in its blueprint:

```yml
# site/blueprints/users/editor.yml
title: Editor
permissions:
  access:
    plausible: false
```

## Requirements

- Kirby 6

## Installation

### Composer (Recommended)

```bash
composer require johannschopplich/kirby-plausible
```

### Manual Installation

Download and copy this repository to `/site/plugins/kirby-plausible`.

## Options

All options are namespaced under `johannschopplich.plausible`:

| Option       | Default              | Description                                                                                      |
| ------------ | -------------------- | ------------------------------------------------------------------------------------------------ |
| `sharedLink` | `''`                 | Plausible shared link the Panel dashboard embeds. Without it, the area shows a setup notice.     |
| `scriptUrl`  | `null`               | Your site's script URL from Plausible. When set, the snippet prints Plausible's current snippet. |
| `domain`     | Host of the site URL | Domain the legacy script reports to. Not used when `scriptUrl` is set.                           |

Example `config.php`:

```php
return [
    'johannschopplich.plausible' => [
        'sharedLink' => 'https://plausible.io/share/example.com?auth=…',
        'scriptUrl' => 'https://plausible.io/js/pa-….js'
    ]
];
```

## Troubleshooting

**The Analytics entry is missing from the Panel menu.** Kirby's `panel.menu` option is an allow-list: once you set it, it has to list the plugin's `plausible` area.

```php
// config.php
return [
    'panel' => [
        'menu' => ['site', 'users', 'system', 'plausible']
    ]
];
```

## Credits

Based on [kirby-plausible](https://github.com/floriankarsten/kirby-plausible) by [Florian Karsten](https://github.com/floriankarsten).

## License

[MIT](./LICENSE) License © 2022-PRESENT [Johann Schopplich](https://github.com/johannschopplich)

[MIT](./LICENSE) License © 2021 [Florian Karsten](https://github.com/floriankarsten)
