<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected string $guard_name = 'web';

    protected function getDefaultGuardName(): string
    {
        return $this->guard_name;
    }
}
