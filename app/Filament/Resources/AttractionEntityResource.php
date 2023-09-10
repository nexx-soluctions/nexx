<?php

namespace App\Filament\Resources;

use App\Enums\AttractionsEntityStatus;
use App\Filament\Resources\AttractionEntityResource\Pages;
use App\Filament\Resources\AttractionEntityResource\RelationManagers;
use App\Models\Modules\ComercialAutomation\AttractionEntity;
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

class AttractionEntityResource extends Resource
{
    protected static ?string $model = AttractionEntity::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Entidades de Atrações';

    protected static ?string $navigationGroup = 'Atrações';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $modelLabel = 'Entidade de Atrações';

    protected static ?string $pluralModelLabel = 'Entidades de Atrações';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Entidade de Atração')
                ->schema([
                    Forms\Components\Select::make('attraction_id')
                        ->label('Atração')
                        ->relationship('attraction', 'name')
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options(AttractionsEntityStatus::options(1)),
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->required(),
                ]),
            Section::make('Visibilidade')
                ->schema([
                    Forms\Components\Toggle::make('active')
                        ->label('Ativo')
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
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable(),
                Tables\Columns\TextColumn::make('attraction.name')
                    ->label('Atração')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Ativo')
                    ->alignCenter()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
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
            'index' => Pages\ListAttractionEntities::route('/'),
            'create' => Pages\CreateAttractionEntity::route('/create'),
            'view' => Pages\ViewAttractionEntity::route('/{record}'),
            'edit' => Pages\EditAttractionEntity::route('/{record}/edit'),
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
