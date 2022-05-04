const path = require('path');

module.exports = {
  entry: ['./assets/app.scss'],
  output: {
    path: path.resolve(__dirname, './assets/build'),
    filename: 'app.js',
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: '../../public/style/',
              name: 'style.min.css',
            },
          },
          'sass-loader',
        ],
      },
    ],
  },
  devServer: {
    static: path.join(__dirname, '/'),
  },
};
