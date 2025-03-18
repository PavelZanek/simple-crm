<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Nationalities',
    'navigation_group' => 'Others',
    'breadcrumb' => 'Nationalities',
    'list' => [
        'title' => 'Nationalities',
    ],
    'create' => [
        'title' => 'Create Nationality',
    ],
    'edit' => [
        'title' => 'Edit Nationality',
    ],
    'attributes' => [
        'name' => 'Nationality Name',
    ],
    'actions' => [
        'modals' => [
            'delete' => [
                'bulk' => [
                    'heading' => 'Delete Nationalities',
                    'description' => 'Are you sure you want to delete the selected nationalities?',
                ],
                'single' => [
                    'heading' => 'Delete Nationality',
                    'description' => 'Are you sure you want to delete this nationality?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Permanently Delete Nationalities',
                    'description' => 'Are you sure you want to permanently delete the selected nationalities?',
                ],
                'single' => [
                    'heading' => 'Permanently Delete Nationality',
                    'description' => 'Are you sure you want to permanently delete this nationality?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Restore Nationalities',
                    'description' => 'Are you sure you want to restore the selected nationalities?',
                ],
                'single' => [
                    'heading' => 'Restore Nationality',
                    'description' => 'Are you sure you want to restore this nationality?',
                ],
            ],
        ],
    ],
];
