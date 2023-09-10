<?php

namespace App\Filament\Resources\EnterpriseResource\Pages;

use App\Filament\Resources\EnterpriseResource;
use Filament\Actions;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateEnterprise extends CreateRecord
{
    use HasWizard;

    protected static string $resource = EnterpriseResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Informações da Empresa')
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
                ]),
            Step::make('Configurações do Banco de Dados')
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
                ]),
            Step::make('Definindo Usuários')
                ->schema([
                    Repeater::make('Usuários')
                        ->relationship('users')
                        ->label('Usuários')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->required(),
                            Forms\Components\TextInput::make('username')
                                ->label('Usuário')
                                ->required(),
                            Forms\Components\TextInput::make('email')
                                ->label('E-mail')
                                ->email()
                                ->required(),
                            Forms\Components\TextInput::make('password')
                                ->label('Senha')
                                ->password()
                                ->required(),
                        ])
                ]),
            Step::make('Definindo Módulos')
                ->schema([
                    Select::make('modules')
                        ->relationship('modules', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Módulos'),
                ]),
        ];
    }
}
