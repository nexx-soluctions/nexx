<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Modules\ComercialAutomation\Product;
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

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Produtos';

    protected static ?string $navigationGroup = 'Pedidos';

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $modelLabel = 'Produto';

    protected static ?string $pluralModelLabel = 'Produtos';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Produto')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Descrição'),
                        Forms\Components\FileUpload::make('image_url')
                            ->label('Imagem')
                            ->image(),
                        Forms\Components\TextInput::make('value')
                            ->label('Valor')
                            ->default(0)
                            ->required(),
                    ]),
                Section::make('Visibilidade')
                    ->schema([
                        Forms\Components\Toggle::make('show_to_waiter')
                            ->label('Mostra para Garçom'),
                        Forms\Components\Toggle::make('show_to_kitchen')
                            ->label('Mostra para Cozinha'),
                        Forms\Components\Toggle::make('show_to_cashier')
                            ->label('Mostra para Caixa'),
                        Forms\Components\Toggle::make('active')
                            ->label('Ativo no Cardápio')
                            ->default(true),
                    ]),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->circular()
                    ->label('Imagem')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Cardápio')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('show_to_waiter')
                    ->label('Garçom')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('show_to_kitchen')
                    ->label('Cozinha')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('show_to_cashier')
                    ->label('Caixa')
                    ->boolean()
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
