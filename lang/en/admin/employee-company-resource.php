<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Companies',
    'navigation_group' => 'Employees',
    'breadcrumb' => 'Companies',
    'list' => [
        'title' => 'Companies',
    ],
    'create' => [
        'title' => 'Create Company',
    ],
    'edit' => [
        'title' => 'Edit Company',
    ],
    'attributes' => [
        'name' => 'Company Name',
    ],
    'actions' => [
        'modals' => [
            'delete' => [
                'bulk' => [
                    'heading' => 'Delete Companies',
                    'description' => 'Are you sure you want to delete the selected companies?',
                ],
                'single' => [
                    'heading' => 'Delete Company',
                    'description' => 'Are you sure you want to delete this company?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Permanently Delete Companies',
                    'description' => 'Are you sure you want to permanently delete the selected companies?',
                ],
                'single' => [
                    'heading' => 'Permanently Delete Company',
                    'description' => 'Are you sure you want to permanently delete this company?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Restore Companies',
                    'description' => 'Are you sure you want to restore the selected companies?',
                ],
                'single' => [
                    'heading' => 'Restore Company',
                    'description' => 'Are you sure you want to restore this company?',
                ],
            ],
        ],
    ],
];
