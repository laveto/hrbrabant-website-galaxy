module.exports = function (options)
{

    return {
        ...options,

        // Overwrite options
        // language: 'en',

        // Add styles
        stylesSet: [
            { name: 'Normaal', element: 'span', attributes: {'class': ''} },

            { name: 'H1 stijl', element: 'span', attributes: {'class': 'h1'} },
            { name: 'H2 stijl', element: 'span', attributes: {'class': 'h2'} },
            { name: 'H3 stijl', element: 'span', attributes: {'class': 'h3'} },
            { name: 'H4 stijl', element: 'span', attributes: {'class': 'h4'} },
            { name: 'H5 stijl', element: 'span', attributes: {'class': 'h5'} },

            { name: 'Font Semibold', element: 'span', attributes: {'class': 'font-semibold'} },
            { name: 'Donkerblauwe knop', element: 'a', attributes: {'class': 'btn-primary'} },
            { name: 'Witte knop, blauwe tekst', element: 'a', attributes: {'class': 'btn-secondary'} },
            { name: 'Uitlijning knop', element: 'a', attributes: {'class': 'btn-outline'} },
        ],

        // Allow tags.
        format_tags: 'p;h1;h2;h3;h4;h5',

    };

};
