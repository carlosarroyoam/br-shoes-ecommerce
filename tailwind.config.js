module.exports = {
    purge: [],
    theme: {
        extend: {
            fontFamily: {
                sans: [
                    'Montserrat',
                    'Open Sans',
                ],
            },
            colors: {
                background: 'var(--color-background)',
                'background-secondary': 'var(--color-background-secondary)',
                primary: 'var(--color-primary)',
                'primary-hover': 'var(--color-primary-hover)',
                'primary-disabled': 'var(--color-primary-disabled)',
                secondary: 'var(--color-secondary)',
                'secondary-hover': 'var(--color-secondary-hover)',
                'secondary-disabled': 'var(--color-secondary-disabled)',
                header: 'var(--color-text-header)',
                'header-secondary': 'var(--color-text-header-secondary)',
                body: 'var(--color-text-body)',
                'body-secondary': 'var(--color-text-body-secondary)',
            },
            spacing: {
                '22': '5.5rem',
                '26': '7rem',
            },
            container: {
                center: true,
                padding: '1rem',
            }
        },
    },
    variants: {},
    plugins: [],
    future: {
        removeDeprecatedGapUtilities: true,
    },
}
