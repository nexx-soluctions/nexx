<?php

namespace App\Filament\Resources;

use App\Enums\OrderItemsStatus;
use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\Modules\ComercialAutomation\OrderItem;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Itens de Pedidos';

    protected static ?string $navigationGroup = 'Pedidos';

    protected static ?string $navigationIcon = 'heroicon-o-folder-plus';

    protected static ?string $modelLabel = 'Item de Pedido';

    protected static ?string $pluralModelLabel = 'Itens de Pedidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Itens do Pedido')
                    ->schema([
                        Forms\Components\Select::make('order_id')
                            ->relationship('order', 'id')
                            ->searchable()
                            ->preload()
                            ->label('Pedido')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options(OrderItemsStatus::options(1))
                            ->default('assessing')
                            ->required(),
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->label('Produto'),
                        Forms\Components\Select::make('attraction_id')
                            ->relationship('attraction', 'name')
                            ->searchable()
                            ->preload()
                            ->label('Atração'),
                            // ->required(),
                        Forms\Components\TextInput::make('value')
                            ->label('Valor')
                            ->default(0)
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Quantidade')
                            ->default(1)
                            ->required(),
                        Forms\Components\TextInput::make('observations')
                            ->label('Observações'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('order.id')
                    ->label('Pedido')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attraction.name')
                    ->label('Atração')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('observations')
                    ->label('Observações')
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
            ->headerActions([
                ExportAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()
                    ]),
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
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'view' => Pages\ViewOrderItem::route('/{record}'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
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
