var path = require("path");
const CopyWebpackPlugin = require('copy-webpack-plugin')

module.exports = {
  entry: "./ttac.js",
  output: {
    path: path.resolve(__dirname, "dist"),
    filename: "ttacjs-wp.js",
    publicPath: "/dist"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        use: {
            loader: 'babel-loader',
            options: {
                presets: ['@babel/preset-env'],
                plugins: []
            }
        }
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: "style-loader" // creates style nodes from JS strings
          },
          {
            loader: "css-loader" // translates CSS into CommonJS
          },
          {
            loader: "sass-loader" // compiles Sass to CSS
          },
          {
            loader: "postcss-loader"
          }
        ]
      }
    ],
  },
  plugins: [
    new CopyWebpackPlugin([{ from: path.resolve(__dirname, 'node_modules/tarteaucitronjs'), to: 'tarteaucitronjs' }])
  ]
};