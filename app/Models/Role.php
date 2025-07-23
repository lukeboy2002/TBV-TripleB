<?php

namespace App\Models;

class Role extends \Spatie\Permission\Models\Role
{
    protected string $guard_name = 'web';

    protected function getDefaultGuardName(): string
    {
        return $this->guard_name;
    }
}
