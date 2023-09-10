<?php

namespace App\Filament\Resources\CardResource\RelationManager;

use App\Enums\OrderItemsStatus;
use App\Enums\OrderStatus;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $title = 'Pedidos';

    protected static ?string $icon = 'heroicon-o-clipboard-document-list';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->orders->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pedido')
                    ->tabs([
                        Tab::make('Informações do Pedido')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->options(OrderStatus::options(1))
                                    ->default('preparing')
                                    ->required(),
                            ]),
                        Tab::make('Itens do Pedido')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                Repeater::make('Itens do Pedido')
                                    ->relationship('orderItems')
                                    ->label('Itens')
                                    ->schema([
                                        Section::make()
                                            ->schema([
                                                Forms\Components\Select::make('status')
                                                    ->options(OrderItemsStatus::options(1))
                                                    ->default('assessing')
                                                    ->required()
                                                    ->columnSpanFull(),
                                                Forms\Components\Select::make('product_id')
                                                    ->relationship('product', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->label('Produto')
                                                    ->columnSpanFull(),
                                                Forms\Components\Select::make('attraction_id')
                                                    ->relationship('attraction', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->label('Atração')
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make('amount')
                                                    ->label('Quantidade')
                                                    ->default(1)
                                                    ->required(),
                                                Forms\Components\TextInput::make('value')
                                                    ->label('Valor')
                                                    ->default(0)
                                                    ->required(),
                                                Forms\Components\Textarea::make('observations')
                                                    ->label('Observações')
                                                    ->columnSpanFull(),
                                            ])->columns(2)
                                    ])->grid(2)
                            ]),
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('card.id')
                    ->label('Comanda')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->alignCenter(),
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
                //
            ])->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Novo pedido'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Novo pedido'),
            ]);
    }
}