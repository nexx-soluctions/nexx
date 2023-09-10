<?php

namespace App\Filament\Resources\UserResource\RelationManager;

use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource\RelationManager\PermissionRelationManager as BasePermissionRelatationManager;
use Illuminate\Database\Eloquent\Model;

class PermissionRelationManager extends BasePermissionRelatationManager
{
    protected static ?string $title = 'Permissões';

    protected static ?string $icon = 'heroicon-o-lock-closed';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->permissions->count();
    }

}