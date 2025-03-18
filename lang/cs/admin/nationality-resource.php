<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Národnosti',
    'navigation_group' => 'Ostatní',
    'breadcrumb' => 'Národnosti',
    'list' => [
        'title' => 'Národnosti',
    ],
    'create' => [
        'title' => 'Vytvořit národnost',
    ],
    'edit' => [
        'title' => 'Upravit národnost',
    ],
    'attributes' => [
        'name' => 'Název národnosti',
    ],
    'actions' => [
        'modals' => [
            'delete' => [
                'bulk' => [
                    'heading' => 'Smazat národnosti',
                    'description' => 'Opravdu chcete smazat vybrané národnosti?',
                ],
                'single' => [
                    'heading' => 'Smazat národnost',
                    'description' => 'Opravdu chcete smazat tuto národnost?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Trvale smazat národnosti',
                    'description' => 'Opravdu chcete trvale smazat vybrané národnosti?',
                ],
                'single' => [
                    'heading' => 'Trvale smazat národnost',
                    'description' => 'Opravdu chcete trvale smazat tuto národnost?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Obnovit národnosti',
                    'description' => 'Opravdu chcete obnovit vybrané národnosti?',
                ],
                'single' => [
                    'heading' => 'Obnovit národnost',
                    'description' => 'Opravdu chcete obnovit tuto národnost?',
                ],
            ],
        ],
    ],
];
