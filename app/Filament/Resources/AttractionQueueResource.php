<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttractionQueueResource\Pages;
use App\Filament\Resources\AttractionQueueResource\RelationManagers;
use App\Models\Modules\ComercialAutomation\AttractionQueue;
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

class AttractionQueueResource extends Resource
{
    protected static ?string $model = AttractionQueue::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Filas de Atrações';

    protected static ?string $navigationGroup = 'Atrações';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $modelLabel = 'Fila de Atrações';

    protected static ?string $pluralModelLabel = 'Filas de Atrações';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Atração')
                ->schema([
                    Forms\Components\Select::make('card_id')
                        ->label('Comanda')
                        ->relationship('card', 'id')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('attraction_id')
                        ->label('Atração')
                        ->relationship('attraction', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Toggle::make('done')
                        ->label('Concluído')
                        ->default(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\IconColumn::make('done')
                    ->label('Ativo')
                    ->alignCenter()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('card.id')
                    ->label('Comanda')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attraction.name')
                    ->label('Atração')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListAttractionQueues::route('/'),
            'create' => Pages\CreateAttractionQueue::route('/create'),
            'view' => Pages\ViewAttractionQueue::route('/{record}'),
            'edit' => Pages\EditAttractionQueue::route('/{record}/edit'),
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
