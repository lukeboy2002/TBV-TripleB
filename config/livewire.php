<?php

return [
    // Configure Livewire temporary upload validation so mobile camera images up to 2 MB are accepted
    'temporary_file_upload' => [
        // Use array syntax as recommended by Livewire. Size is in kilobytes.
        'rules' => ['image', 'max:2048'],

        // Ensure Livewire uses the local disk for temporary uploads and a known directory
        'disk' => 'local',
        'directory' => 'livewire-tmp',
    ],
];
