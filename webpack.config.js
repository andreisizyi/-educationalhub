//Подключаю заранее загруженный через npm плагин для CSS SCSS
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
//Подключаю константу path для вывода
const path = require('path');
//Подключаю константу webpack для глобальной регистрации плагина jQuery
const webpack = require('webpack');

const PolyfillInjectorPlugin = require('webpack-polyfill-injector');

module.exports = [
 {
	//mode: 'development',
	mode: 'production',
	entry: './js/app.js',
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: 'bundle.js'
	},
	module: {
	  rules: [
		//Если нужен полифил babel для конвертации ES6 в ES5 для неподдерживающих новый стандарт браузеров
		/*{
		  test: /\.m?js$/,
		  exclude: /(node_modules|bower_components)/,
		  use: {
			loader: 'babel-loader',
			options: {
			  presets: ['@babel/preset-env']
			}
		  }
		},*/
		{
		  test:/\.(s*)css$/,
		  use: [
			MiniCssExtractPlugin.loader, // instead of style-loader
			'css-loader',
			'sass-loader',
		  ]
		},
		{
		  test: /\.(gif|png|jpe?g|svg|eot|ttf|woff)$/i,
		  use: [
			'file-loader',
			{
			  loader: 'image-webpack-loader',
			  options: {
				bypassOnDebug: true, // webpack@1.x
				disable: true, // webpack@2.x and newer
			  },
			},
		  ],
		}
	  ]
	},
	plugins: [
		new MiniCssExtractPlugin(),
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			"window.jQuery": 'jquery'
		})
	]
}
]