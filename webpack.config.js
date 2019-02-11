const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = () => {
  return {
    plugins: [
      new MiniCssExtractPlugin({
        filename: "style.bundle.css",
      }),
    ],
    entry: {
      main: [
        "./js/theme.js",
        "./sass/theme.scss",
      ],
    },
    output: {
      path: path.resolve(__dirname, "./bundle"),
      filename: "[name].bundle.js",
    },
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          loader: "babel-loader",
          options: {
            cwd: "./",
          },
        },
        {
          test: /\.s?css$/,
          use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader", "postcss-loader"],
        },
      ],
    },
  };
};