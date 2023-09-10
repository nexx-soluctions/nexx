<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnterpriseResource\Pages;
use App\Filament\Resources\EnterpriseResource\RelationManager\ModulesRelationManager;
use App\Filament\Resources\EnterpriseResource\RelationManager\UsersRelationManager;
use App\Models\Enterprise;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EnterpriseResource extends Resource
{
    protected static ?string $model = Enterprise::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?int $navigationSort = -4;

    protected static ?string $navigationLabel = 'Empresas';

    protected static ?string $navigationGroup = 'Gerenciamento';

    protected static ?string $modelLabel = 'Empresa';

    protected static ?string $pluralModelLabel = 'Empresas';

    protected static ?string $recordTitleAttribute = 'name';

    protected static int $globalSearchResoltsLimit = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Label')
                    ->tabs([
                        Tab::make('Informações da Empresa')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nome')
                                    ->required(),
                                Forms\Components\TextInput::make('dns')
                                    ->label('Endereço DNS'),
                                Forms\Components\Toggle::make('active')
                                    ->label('Ativo')
                                    ->default(true),
                                Forms\Components\Toggle::make('show_landing_page')
                                    ->label('Landing Pages'),
                            ])->columns(2),
                        Tab::make('Configurações do Banco de Dados')
                            ->icon('heroicon-o-circle-stack')
                            ->schema([
                                Forms\Components\TextInput::make('db_url')
                                    ->label('Database URL'),
                                Forms\Components\TextInput::make('db_host')
                                    ->label('Database Host'),
                                Forms\Components\TextInput::make('db_port')
                                    ->label('Database Porta'),
                                Forms\Components\TextInput::make('db_user')
                                    ->label('Database Usuário'),
                                Forms\Components\TextInput::make('db_password')
                                    ->label('Database Senha')
                                    ->password(),
                        ])->columns(2),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('active')
                    ->label('Ativo')
                    ->alignCenter()
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('show_landing_page')
                    ->label('Landing Page')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dns')
                    ->label('Endereço DNS')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('db_url')
                    ->label('Database URL')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('db_host')
                    ->label('Database Host')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('db_port')
                    ->label('Database Port')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('db_user')
                    ->label('Database User')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Action::make('migrate')
                    ->label('Executar Migration')
                    ->icon('heroicon-o-circle-stack')
                    ->color(Color::Orange)
                    ->action(function(Enterprise $enterprise) {
                        try {
                            $enterprise->executeMigration();

                            Notification::make()
                                ->title('Executado com sucesso')
                                ->body('Migração do banco de dados realizada com sucesso.')
                                ->success()
                                ->send();
                        } catch (\Throwable $th) {
                            Notification::make()
                                ->title('Erro ao executar a migração')
                                ->body('Falha ao se conectar com o banco de dados.')
                                ->warning()
                                ->send();
                        }
                    })
                    ->requiresConfirmation(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
            ModulesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnterprises::route('/'),
            'create' => Pages\CreateEnterprise::route('/create'),
            'view' => Pages\ViewEnterprise::route('/{record}'),
            'edit' => Pages\EditEnterprise::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
