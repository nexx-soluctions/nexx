<?php

namespace App\Filament\Resources\UserResource\RelationManager;

use Althinect\FilamentSpatieRolesPermissions\Resources\PermissionResource\RelationManager\RoleRelationManager as BaseRoleRelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RoleRelationManager extends BaseRoleRelationManager
{
    protected static ?string $title = 'Papéis';

    protected static ?string $icon = 'heroicon-o-users';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->roles->count();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name')),
                TextColumn::make('guard_name')
                    ->searchable()
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name')),
            ])
            ->filters([
                //
            ])->headerActions([
                AttachAction::make('Attach Permission')->preloadRecordSelect()->after(fn() => app()
                    ->make(RoleReis::class)
                    ->forgetCachedPermissions()),
            ])->actions([
                DetachAction::make()->after(fn() => app()->make(PermissionRegistrar::class)->forgetCachedPermissions()),
            ])->bulkActions([
                DetachBulkAction::make()->after(fn() => app()->make(PermissionRegistrar::class)->forgetCachedPermissions()),
            ]);
    
    }

}