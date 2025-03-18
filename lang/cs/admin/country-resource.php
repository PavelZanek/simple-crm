<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Země',
    'navigation_group' => 'Ostatní',
    'breadcrumb' => 'Země',
    'list' => [
        'title' => 'Země',
    ],
    'create' => [
        'title' => 'Vytvořit zemi',
    ],
    'edit' => [
        'title' => 'Upravit zemi',
    ],
    'attributes' => [
        'name' => 'Název země',
    ],
    'actions' => [
        'modals' => [
            'delete' => [
                'bulk' => [
                    'heading' => 'Smazat země',
                    'description' => 'Opravdu chcete smazat vybrané země?',
                ],
                'single' => [
                    'heading' => 'Smazat zemi',
                    'description' => 'Opravdu chcete smazat tuto zemi?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Trvale smazat země',
                    'description' => 'Opravdu chcete trvale smazat vybrané země?',
                ],
                'single' => [
                    'heading' => 'Trvale smazat zemi',
                    'description' => 'Opravdu chcete trvale smazat tuto zemi?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Obnovit země',
                    'description' => 'Opravdu chcete obnovit vybrané země?',
                ],
                'single' => [
                    'heading' => 'Obnovit zemi',
                    'description' => 'Opravdu chcete obnovit tuto zemi?',
                ],
            ],
        ],
    ],
];
