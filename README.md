# Airwire demo

This app serves as a demo of Airwire.

Currently it only has a Vue demo, but we'll replicate it in Alpine very soon.

## Installation

Simply clone the repository and serve the app.

The database should be included. If it's not found, run `touch database/database.sqlite`.

To refresh the database, run `php artisan migrate:fresh`.

## Highlights

- `app/Airwire` contains all of the backend logic
- `resources/js/app.ts` contains the JavaScript setup
- `resources/js/components` contains all of the Vue components that use Airwire
