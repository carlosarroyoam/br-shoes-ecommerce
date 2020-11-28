// tailwind.config.js
const colors = require('tailwindcss/colors');

module.exports = {
	purge: [
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php'
	],
	darkMode: false, // or 'media' or 'class'
	theme: {
		extend: {
			fontFamily: {
				serif: ['Prata', 'ui-serif', 'serif'],
				sans: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif']
			},
			colors: {
				primary: {
					DEFAULT: '#013347',
					hover: '#012b3b'
				},
				secondary: {
					DEFAULT: ''
				},
				background: colors.gray[50],
				surface: {
					DEFAULT: colors.gray[100],
					secondary: colors.gray[200]
				}
			},
			container: {
				center: true,
				padding: '1rem'
			}
		}
	}
};
