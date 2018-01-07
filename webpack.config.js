const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
var ExtractCSS = new ExtractTextPlugin('[name]');

module.exports = {
    entry: {
        './assets/js/main.js': "./assets/js/src/app.js",
        './assets/js/vendors.js': "./assets/js/src/vendors.js",
        './style.css': "./assets/sass/main.scss",
        './woocommerce.css': "./assets/sass/woocommerce.scss"
    },
    externals: {
        jquery: 'jQuery'
    },
    output: {
        filename: '[name]',
        path: path.resolve(__dirname),
    },
    devtool: 'source-map',
    module: {
        rules: [{
            test: /\.scss$/,
            exclude: /node_modules/,
            use: ExtractCSS.extract({
                fallback: 'style-loader',
                use: [{
                        loader: "css-loader",
                        options: {
                            importLoaders: 1,
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: true
                        }
                    }, {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            })
        }]
    },
    plugins: [
        ExtractCSS
    ]
};
