<?php

declare(strict_types=1);

return [
    'navigation_label' => 'Templates',
    'navigation_group' => 'Employees',
    'breadcrumb' => 'Templates',
    'list' => [
        'title' => 'Templates',
    ],
    'create' => [
        'title' => 'Create Template',
    ],
    'edit' => [
        'title' => 'Edit Template',
    ],
    'attributes' => [
        'name' => 'Template Name',
        'document' => 'Document',
    ],
    'actions' => [
        'available_variables' => 'Available Variables',
        'download_sample' => 'Download Sample File',
        'download_sample_success' => 'Sample file has been successfully downloaded.',
        'modals' => [
            'available_variables' => [
                'heading' => 'Available Variables',
                'description' => 'Below are the available variables that you can use in the template.',
                'variable' => 'Variable',
                'variable_description' => 'Variable Description',
            ],
            'delete' => [
                'bulk' => [
                    'heading' => 'Delete Templates',
                    'description' => 'Are you sure you want to delete the selected templates?',
                ],
                'single' => [
                    'heading' => 'Delete Template',
                    'description' => 'Are you sure you want to delete this template?',
                ],
            ],
            'force_delete' => [
                'bulk' => [
                    'heading' => 'Permanently Delete Templates',
                    'description' => 'Are you sure you want to permanently delete the selected templates?',
                ],
                'single' => [
                    'heading' => 'Permanently Delete Template',
                    'description' => 'Are you sure you want to permanently delete this template?',
                ],
            ],
            'restore' => [
                'bulk' => [
                    'heading' => 'Restore Templates',
                    'description' => 'Are you sure you want to restore the selected templates?',
                ],
                'single' => [
                    'heading' => 'Restore Template',
                    'description' => 'Are you sure you want to restore this template?',
                ],
            ],
        ],
    ],
];
