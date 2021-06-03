const mix = require('laravel-mix');
const jsSource = require('./resources/app/_include/scripts/source');
mix.setPublicPath('./public');
mix.options({
    terser: {
        extractComments: false,
        terserOptions: {
            format: {
                comments: false,
            },
        },
    },
    cssNano: {discardComments: false},
    processCssUrls: false,
});
mix.version();
mix.sourceMaps(false, 'inline-source-map');
mix.sass('./resources/app/_include/sass/style.scss', './public/assets/css/', null, [
    require('postcss-discard-comments')({removeAll: true}),
    require('autoprefixer')(),
    require('rtlcss')()
]);
mix.scripts(jsSource.js, './public/assets/js/script.js');
mix.disableNotifications();
