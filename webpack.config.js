const path = require( 'path' )
const postcssPresetEnv = require( 'postcss-preset-env' )
const postcssRem = require( 'postcss-rem' )
const postcssColorMod = require( 'postcss-color-mod-function' )
const postcssAtVariables = require( 'postcss-at-rules-variables' )
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' )
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' )
const IgnoreEmitPlugin = require( 'ignore-emit-webpack-plugin' )

const config = {
	entry: {
		// 'admin-script': path.resolve( process.cwd(), 'src/js', 'admin.js' ),
		// script: path.resolve( process.cwd(), 'src/js', 'script.js' ),
		'editor-style': path.resolve( process.cwd(), 'src/scss', 'editor.scss' ),
		'login-style': path.resolve( process.cwd(), 'src/scss', 'login.scss' ),
		style: path.resolve( process.cwd(), 'src/scss', 'style.scss' ),
	},
	output: {
		filename: '[name].js',
		path: path.resolve( process.cwd(), 'dist' ),
	},
	optimization: {
		splitChunks: {
			cacheGroups: {
				'editor-style': {
					name: 'editor-style',
					test: /editor\.(sc|sa|c)ss$/,
					chunks: 'all',
					enforce: true,
				},
				'login-style': {
					name: 'login-style',
					test: /login\.(sc|sa|c)ss$/,
					chunks: 'all',
					enforce: true,
				},
				style: {
					name: 'style',
					test: /style\.(sc|sa|c)ss$/,
					chunks: 'all',
					enforce: true,
				},
				default: false,
			},
		},
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					require.resolve( 'thread-loader' ),
					{
						loader: require.resolve( 'babel-loader' ),
						options: {
							// Babel uses a directory within local node_modules
							// by default. Use the environment variable option
							// to enable more persistent caching.
							cacheDirectory: process.env.BABEL_CACHE_DIRECTORY || true,
						},
					},
				],
			},
			{
				test: /\.(sc|sa|c)ss$/,
				exclude: /node_modules/,
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
					},
					{
						loader: 'css-loader',
						options: {
							url: false,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									postcssPresetEnv( {
										stage: 3,
										features: {
											'custom-media-queries': {
												preserve: false,
											},
											'custom-properties': {
												preserve: true,
											},
											'nesting-rules': true,
										},
										autoprefixer: {
											remove: false,
										},
									} ),
									postcssRem( {
										/* baseline: 10, // Default to 16 */
										/* convert: 'px', // Default to rem */
										// fallback: true,
										precision: 6, // Default to 5
									} ),
									postcssColorMod(),
									postcssAtVariables( {
										atRules: [ 'media' ],
									} ),
								],
							},
						},
					},
					{
						loader: 'sass-loader',
					},
				],
			},
		],
	},
	plugins: [
		new CleanWebpackPlugin(),
		new MiniCssExtractPlugin( {
			filename: '[name].css',
		} ),
		new IgnoreEmitPlugin( [ 'style.js' ] ),
	],
}

module.exports = ( env, argv ) => {
	config.mode = argv.mode
	if ( argv.mode === 'development' ) {
		config.devtool = 'source-map'
	}
	return config
}
