<?php

use Illuminate\Support\Facades\Storage;

function current_user()
{
    return auth()->user();
}

if (! function_exists('get_initials')) {
    function get_initials(string $name): ?string
    {
        $words = explode(' ', $name);
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0] ?? '';
        }

        return $initials;
    }
}

if (! function_exists('create_avatar')) {
    function create_avatar(string $name, string $filename, string $path): string
    {
        $avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();
        $source = $avatar->background('#000')->color('#fff')->name($name)->generate()->stream();

        Storage::disk('public')->put($path.$filename, $source);

        return $path.$filename;
    }
}

if (! function_exists('storage_exists')) {
    function storage_exists($file, $disk = 'public'): bool
    {
        if ($file == '') {
            return false;
        }

        return Storage::disk($disk)->exists($file);
    }
}

if (! function_exists('storage_url')) {
    function storage_url($file, $disk = 'public'): string
    {
        return Storage::url($file);
    }
}
