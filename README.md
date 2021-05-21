# Airwire demo

This app serves as a demo of [Airwire](https://github.com/archtechx/airwire).

Currently it only has a Vue demo, but we'll replicate it in Alpine very soon.

## Installation

Simply clone the repository and serve the app.

The database should be included. If it's not found, run `touch database/database.sqlite`.

To refresh the database, run `php artisan migrate:fresh`.

## Highlights

- [`app/Airwire`](https://github.com/archtechx/airwire-demo/tree/master/app/Airwire) contains all of the backend logic
- [`resources/js/app.ts`](https://github.com/archtechx/airwire-demo/blob/master/resources/js/app.ts) contains the JavaScript setup
- [`resources/js/components`](https://github.com/archtechx/airwire-demo/tree/master/resources/js/components) contains all of the Vue components that use Airwire
