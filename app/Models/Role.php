<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    public function scopeSearch($query, $value) {
        $query->where('name', 'like', "%{$value}%");
    }
}
