const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
	...defaultConfig,
	module: {
		...defaultConfig.module,
		rules: [...defaultConfig.module.rules],
	},
	context: path.resolve(__dirname, 'public/pages'),
	entry: {
		frontPage: './front-page/frontPage.js',
		shop: './shop/shop.js',
		singleProduct: './single-product/singleProduct.js',
		reels: './reels/reels.js',
		singleReels: './single-reels/singleReels.js',
		blogs: './blogs/blogs.js',
		blog: './blog/blog.js',
		cart: './cart/cart.js',
		checkout: './checkout/checkout.js',
		thankYou: './thank-you/thankYou.js',
		aboutUs: './about-us/aboutUs.js',
		contactUs: './contact-us/contactUs.js',
		privacyPolicy: './privacy-policy/privacyPolicy.js',
		termsAndConditions: './terms-and-conditions/termsAndConditions.js',
		refundPolicy: './refund-policy/refundPolicy.js',
		notFound: './not-found/notFound.js',
		success: './success/success.js',
	},
	devServer: {
		static: './build',
		hot: true,
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name]/[name].css',
		}),
	],

	output: {
		filename: '[name]/[name].bundle.js',
		path: path.resolve(__dirname, 'build'),
		publicPath: 'build',
	},
};
