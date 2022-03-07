const path = require('path');

module.exports = {
    output: { publicPath: '/laravel/' },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
