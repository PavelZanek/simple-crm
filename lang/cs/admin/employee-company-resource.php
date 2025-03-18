<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Společnosti',
    'navigation_group' => 'Zaměstnanci',
    'breadcrumb' => 'Společnosti',
    'list' => [
        'title' => 'Společnosti',
    ],
    'create' => [
        'title' => 'Vytvořit společnost',
    ],
    'edit' => [
        'title' => 'Upravit společnost',
    ],
    'attributes' => [
        'name' => 'Název společnosti',
    ],
    'actions' => [
        'modals' => [
            'delete' => [
                'bulk' => [
                    'heading' => 'Smazat společnosti',
                    'description' => 'Opravdu chcete smazat vybrané společnosti?',
                ],
                'single' => [
                    'heading' => 'Smazat společnost',
                    'description' => 'Opravdu chcete smazat tuto společnost?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Trvale smazat společnosti',
                    'description' => 'Opravdu chcete trvale smazat vybrané společnosti?',
                ],
                'single' => [
                    'heading' => 'Trvale smazat společnost',
                    'description' => 'Opravdu chcete trvale smazat tuto společnost?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Obnovit společnosti',
                    'description' => 'Opravdu chcete obnovit vybrané společnosti?',
                ],
                'single' => [
                    'heading' => 'Obnovit uživatele',
                    'description' => 'Opravdu chcete obnovit tuto společnost?',
                ],
            ],
        ],
    ],
];
