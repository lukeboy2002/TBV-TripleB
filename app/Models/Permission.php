<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    public function scopeSearch($query, $value) {
        $query->where('name', 'like', "%{$value}%");
    }
}
