<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Šablony',
    'navigation_group' => 'Zaměstnanci',
    'breadcrumb' => 'Šablony',
    'list' => [
        'title' => 'Šablony',
    ],
    'create' => [
        'title' => 'Vytvořit šablonu',
    ],
    'edit' => [
        'title' => 'Upravit šablonu',
    ],
    'attributes' => [
        'name' => 'Název šablony',
        'document' => 'Dokument',
    ],
    'actions' => [
        'available_variables' => 'Dostupné proměnné',
        'download_sample' => 'Stáhnout vzorový soubor',
        'download_sample_success' => 'Vzorový soubor byl úspěšně stažen.',
        'modals' => [
            'available_variables' => [
                'heading' => 'Dostupné proměnné',
                'description' => 'Níže jsou uvedeny dostupné proměnné, které můžete použít ve šabloně.',
                'variable' => 'Proměnná',
                'variable_description' => 'Popis proměnné',
            ],
            'delete' => [
                'bulk' => [
                    'heading' => 'Smazat šablony',
                    'description' => 'Opravdu chcete smazat vybrané šablony?',
                ],
                'single' => [
                    'heading' => 'Smazat šablonu',
                    'description' => 'Opravdu chcete smazat tuto šablonu?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Trvale smazat šablony',
                    'description' => 'Opravdu chcete trvale smazat vybrané šablony?',
                ],
                'single' => [
                    'heading' => 'Trvale smazat šablonu',
                    'description' => 'Opravdu chcete trvale smazat tuto šablonu?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Obnovit šablony',
                    'description' => 'Opravdu chcete obnovit vybrané šablony?',
                ],
                'single' => [
                    'heading' => 'Obnovit šablonu',
                    'description' => 'Opravdu chcete obnovit tuto šablonu?',
                ],
            ],
        ],
    ],
];
