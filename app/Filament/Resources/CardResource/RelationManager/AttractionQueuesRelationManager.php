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

class AttractionQueuesRelationManager extends RelationManager
{
    protected static string $relationship = 'attractionQueues';

    protected static ?string $title = 'Filas de Atrações';

    protected static ?string $icon = 'heroicon-o-queue-list';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->attractionQueues->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Atração')
                ->schema([
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

    public function table(Table $table): Table
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
                //
            ])->headerActions([
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
            ]);
    }
}