<?php

namespace App\Filament\Resources\UserResource\RelationManager;

use Illuminate\Database\Eloquent\Model;
use Tapp\FilamentAuthenticationLog\RelationManagers\AuthenticationLogsRelationManager as BaseAuthenticationLogsRelationManager;

class AuthenticationLogsRelationManager extends BaseAuthenticationLogsRelationManager
{
    protected static ?string $icon = 'heroicon-o-shield-check';
}