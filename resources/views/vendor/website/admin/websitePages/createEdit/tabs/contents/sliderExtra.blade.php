@input('switch', [
    'name' => 'output_options[show_vacancy_search]',
    'label' => 'Toon vacature zoekbalk',
    'checked' => @$websitePage->output_options['show_vacancy_search'] ?? 0,
])
