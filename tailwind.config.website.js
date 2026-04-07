module.exports = {
    theme: {
        extend: {
            colors: {
                palette: {
                    lightblue: '#E88A85',
                    lighterblue: '#EDA5A1',
                    lightestblue: '#FDF2F1',
                    blue: '#D65A54',
                    darkblue: '#A8403B',
                    darkishblue: '#DE726D',
                    grayishblue: '#B54B46',
                    grayishlighterbue: '#C25550',
                    darkgray: '#4B5563',
                    gray: '#9CA3AF',
                    green: '#50B49B',
                    orange: '#F18F03',
                }
            },
        },
        fontFamily: {
            roboto: ['Roboto', 'sans-serif'],
        },
    },

    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],

    content: [
        __dirname + '/galaxy/modules/*/resources/**/*.{vue,js,scss,php}',
        __dirname + '/app/Modules/*/resources/**/*.{vue,js,scss,php}',
        __dirname + '/app/Modules/*/Http/**/*.{vue,js,scss,php}',
        __dirname + '/resources/**/*.{vue,js,scss,php}',
        __dirname + '/config/galaxy/*.{vue,js,scss,php}',
    ],
};
