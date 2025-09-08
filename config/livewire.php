<?php

return [
    // Configure Livewire temporary upload validation so mobile camera images up to 2 MB are accepted
    'temporary_file_upload' => [
        // Use array syntax as recommended by Livewire. Size is in kilobytes.
        'rules' => ['image', 'max:2048'],

        // You can optionally set disk and directory for temp uploads if needed.
        // 'disk' => null,
        // 'directory' => null,
    ],
];
