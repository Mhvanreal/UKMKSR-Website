# AGENTS.md

Website for UKM KSR (Indonesian campus PMI first-aid unit), Laravel 12 + Blade + Tailwind 3 + Flowbite/Alpine + MySQL. All UI text, docs, and commit messages are in **Indonesian** — keep it that way.

## Commands

- `composer run dev` — runs `artisan serve` + `queue:listen` + `pail` + `npm run dev` concurrently (composer.json `dev` script).
- Frontend: `npm run dev` / `npm run build`. Tailwind 3 is wired via **PostCSS** (`postcss.config.js` + `tailwind.config.js`). `@tailwindcss/vite` is installed but unused — do not migrate to it. Flowbite and Alpine are imported in `resources/js/app.js`.
- Tests: `php artisan test`. **Gotcha:** the sqlite config in `phpunit.xml` is commented out, so tests run against the real MySQL DB from `.env` (RefreshDatabase wipes + remigrates it). Never run tests against production data.
- Uploads require `php artisan storage:link` (`public/storage` → `storage/app/public`).

## Auth & access

- Admin routes in `routes/web.php` are wrapped in `['auth', 'humas_ksr']`. `humas_ksr` (and `admin`) alias to `App\Http\Middleware\AdminMiddleware`, which only allows `auth()->user()->role === 'humas_ksr'`. Aliases are registered in `bootstrap/app.php`.
- Public/landing routes are unauthenticated and defined in the "landing Page" section at the bottom of `routes/web.php`.

## Recruitment (rekrutmen) auto schedule

- Registered every minute in `routes/console.php` → command `app/Console/Commands/CheckRekrutmenSchedule` → `PengaturanRekrutmen::autoCheckStatus()`.
- Manual test: `php artisan rekrutmen:check-schedule`; inspect with `schedule:list` / `schedule:work`. Production requires cron (see `SETUP_SCHEDULER.md`).
- `manual_override` column: manual toggle sets it so the scheduler won't immediately override; clearing it re-enables auto-check.
- `FITUR_REKRUTMEN.md` and `FITUR_AUTO_REKRUTMEN.md` document the feature.

## Clustering feature needs a separate Flask server

- `ClusteringController::cluster()` POSTs to `http://127.0.0.1:5000/cluster` (KMeans + elbow method) and `dd()`s on failure. Start it with `python cluster/app.py`; deps in `cluster/requirments.txt` (note the filename typo).

## Intentional naming quirks — don't "fix"

- Controller/route/view dir is `Rekrutment` (with `t`) but the model/table is `Rekrutmen`.
- Model is `Devisi` (not "Divisi"); route is `/devisi`.
- DB columns mix PascalCase/camelCase/snake: `Nama`, `No_tlpn`, `Agama`, `Gol_darah`, `No_pendaftaran`. Match existing usage in queries.

## Hosting / repo-root quirks

- The repo root is the production web root: a root `index.php` + `.htaccess` boot the app. `public/index.php`, `public/.htaccess`, `public/robots.txt`, `public/favicon.ico`, and `public/build` are gitignored — don't assume the standard `public/` front controller exists.
- Root artifacts that are not part of the app — leave alone: `test_fitur_onoff.php`, `update_time.php`, `cgi-bin/`, `img/`, `layanan/` (uploaded image copies).
- `docker-compose.yml` mounts `./src`, which does not exist — the Docker setup is stale; develop with `php artisan serve`.
