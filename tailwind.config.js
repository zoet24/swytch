/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ['!**/vendor/**', './**/*.twig'],
	theme: {
		colors: {
			content: '#0D1529',
			green: '#078080',
			'grey-light': '#F8F8F8',
			'grey-dark': '#A8A8A8',
			white: '#FEFEFE',
		},
		extend: {
			fontFamily: {
				body: ['Arial', 'sans-serif'],
			},
			fontSize: {
				h1: [
					'32px',
					{
						lineHeight: '100%',
						fontWeight: '700',
					},
				],
				h2: [
					'32px',
					{
						lineHeight: '115%',
						fontWeight: '700',
						letterSpacing: '0.02em',
					},
				],
				h3: [
					'20px',
					{
						lineHeight: '100%',
						fontWeight: '700',
					},
				],
				index: [
					'40px',
					{
						lineHeight: '100%',
						fontWeight: '700',
					},
				],
				body: [
					'16px',
					{
						fontWeight: '400',
					},
				],
			},
		},
	},
	plugins: [],
};
