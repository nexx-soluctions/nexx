<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardClosingResource\Pages;
use App\Filament\Resources\CardClosingResource\RelationManagers;
use App\Models\Modules\ComercialAutomation\CardClosing;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CardClosingResource extends Resource
{
    protected static ?string $model = CardClosing::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Fechamento de Comanda';

    protected static ?string $navigationGroup = 'Extrato';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $modelLabel = 'Fechamento de Comanda';

    protected static ?string $pluralModelLabel = 'Fechamento Comanda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Fechamento de Comanda')
                    ->schema([
                        Forms\Components\Select::make('card_id')
                            ->relationship('card', 'id')
                            ->label('Comanda')
                            ->required(),
                        Forms\Components\Toggle::make('completed')
                            ->label('Completo')
                            ->default(false)
                            ->hiddenOn('create'),
                        Forms\Components\TextInput::make('value')
                            ->label('Valor')
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('card.id')
                    ->label('Comanda')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('completed')
                    ->label('Completo')
                    ->sortable()
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCardClosings::route('/'),
            'create' => Pages\CreateCardClosing::route('/create'),
            'view' => Pages\ViewCardClosing::route('/{record}'),
            'edit' => Pages\EditCardClosing::route('/{record}/edit'),
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
