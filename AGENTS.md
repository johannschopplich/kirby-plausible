# Kirby Plausible

Kirby CMS plugin that embeds a Plausible shared-link dashboard in a Panel area and ships a `plausible` snippet for the tracking script.

## Commands

```bash
composer test
composer csfix         # lives in tools/phpcs/vendor/bin/, not vendor/bin/
pnpm run test:types
pnpm run lint
pnpm run build         # after a change in src/panel/; index.js and index.css are committed
```

## Conventions

- The plugin ships without `vendor/`, so it takes no runtime Composer dependency.
- The dashboard is sized by Plausible's `embed.host.js` (iframe-resizer), loaded from the shared link's origin. It sizes `[plausible-embed]` iframes once on load; `DashboardView.vue` hands it every iframe mounted later.
