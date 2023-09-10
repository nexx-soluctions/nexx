<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttractionResource\Pages;
use App\Filament\Resources\AttractionResource\RelationManagers;
use App\Models\Modules\ComercialAutomation\Attraction;
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

class AttractionResource extends Resource
{
    protected static ?string $model = Attraction::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Atrações';

    protected static ?string $navigationGroup = 'Atrações';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $modelLabel = 'Atração';

    protected static ?string $pluralModelLabel = 'Atrações';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Atração')
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
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Cardápio')
                    ->sortable()
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Imagem')
                    ->sortable()
                    ->alignCenter()
                    ->circular(),
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
            'index' => Pages\ListAttractions::route('/'),
            'create' => Pages\CreateAttraction::route('/create'),
            'view' => Pages\ViewAttraction::route('/{record}'),
            'edit' => Pages\EditAttraction::route('/{record}/edit'),
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
