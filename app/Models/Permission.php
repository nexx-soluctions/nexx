<?php

namespace App\Models;

use App\Policies\PermissionPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as BaseModel;

class Permission extends BaseModel
{
    use HasFactory;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Permission::class => PermissionPolicy::class,
    ];
}
