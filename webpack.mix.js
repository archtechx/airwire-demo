const mix = require('laravel-mix');
const exec = require('child_process').exec;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.ts('resources/js/app.ts', 'public/js')
    .webpackConfig({
        plugins: [
            new (require('./vendor/archtechx/airwire/resources/js/AirwireWatcher'))(require('chokidar'), 'app/**/*.php'),
        ],
        module: {
           rules: [
               // We're registering the TypeScript loader here. It should only
               // apply when we're dealing with a `.ts` or `.tsx` file.
               {
                   test: /\.tsx?$/,
                   loader: 'ts-loader',
                   options: { appendTsSuffixTo: [/\.vue$/] },
                   exclude: /node_modules/,
               },
           ],
       },

       resolve: {
           // We need to register the `.ts` extension so Webpack can resolve
           // TypeScript modules without explicitly providing an extension.
           // The other extensions in this list are identical to the Mix
           // defaults.
           extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx'],
       },
    })
    .vue()

    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ]);
