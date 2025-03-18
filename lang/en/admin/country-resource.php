<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Countries',
    'navigation_group' => 'Others',
    'breadcrumb' => 'Countries',
    'list' => [
        'title' => 'Countries',
    ],
    'create' => [
        'title' => 'Create Country',
    ],
    'edit' => [
        'title' => 'Edit Country',
    ],
    'attributes' => [
        'name' => 'Country Name',
    ],
    'actions' => [
        'modals' => [
            'delete' => [
                'bulk' => [
                    'heading' => 'Delete Countries',
                    'description' => 'Are you sure you want to delete the selected countries?',
                ],
                'single' => [
                    'heading' => 'Delete Country',
                    'description' => 'Are you sure you want to delete this country?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Permanently Delete Countries',
                    'description' => 'Are you sure you want to permanently delete the selected countries?',
                ],
                'single' => [
                    'heading' => 'Permanently Delete Country',
                    'description' => 'Are you sure you want to permanently delete this country?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Restore Countries',
                    'description' => 'Are you sure you want to restore the selected countries?',
                ],
                'single' => [
                    'heading' => 'Restore Country',
                    'description' => 'Are you sure you want to restore this country?',
                ],
            ],
        ],
    ],
];
