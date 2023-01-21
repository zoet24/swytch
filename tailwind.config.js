/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ['!**/vendor/**', './**/*.twig'],
	theme: {
		colors: {
			content: '#0D1529',
			'grey-light': '#F8F8F8',
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
				index: [
					'40px',
					{
						lineHeight: '100%',
						fontWeight: '700',
					},
				],
			},
		},
	},
	plugins: [],
};
