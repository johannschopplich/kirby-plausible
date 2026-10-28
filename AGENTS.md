# Kirby Plausible

Kirby CMS plugin that embeds a Plausible shared-link dashboard in a Panel area and ships a `plausible` snippet for the tracking script.

## Commands

```bash
composer test          # PHPUnit
composer csfix         # php-cs-fixer, lives in tools/phpcs/vendor/bin/, not vendor/bin/
pnpm run test:types    # typecheck with vue-tsc
pnpm run lint          # ESLint
pnpm run build         # build the Panel bundle (index.js / index.css)
```

## Conventions

- The plugin ships without `vendor/`, so it takes no runtime Composer dependency.
- The dashboard is sized by Plausible's `embed.host.js` (iframe-resizer), loaded from the shared link's origin so self-hosted instances work. It sizes `[plausible-embed]` iframes once on load; `PlausibleView.vue` hands it every iframe mounted later.

## Search Hints

- `k-plausible-view` – the Panel view component
- `johannschopplich.plausible.` – option and translation key prefix
