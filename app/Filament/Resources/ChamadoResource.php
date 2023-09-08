<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChamadoResource\Pages;
use App\Models\Chamado;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChamadoResource extends Resource
{
    protected static ?string $model = Chamado::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Chamados';

    protected static ?string $navigationGroup = 'Chamados';

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?string $modelLabel = 'Chamado';

    protected static ?string $pluralModelLabel = 'Chamados';

    protected static ?string $recordTitleAttribute = 'problem';

    protected static int $globalSearchResoltsLimit = 20;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Criado por' => $record->created_by,
            'Categoria' => $record->chamadoCategory->name,
        ]; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Chamado')
                    ->schema([
                        Forms\Components\Select::make('chamado_category_id')
                            ->label('Categoria')
                            ->relationship('chamadoCategory', 'name')
                            ->helperText('O tipo de problema que está acontecendo.')
                            ->required(),
                        Forms\Components\Textarea::make('problem')
                            ->label('Problema')
                            ->helperText('Descreva o problema que está acontecendo.')
                            ->required(),
                        Forms\Components\TextInput::make('place')
                            ->label('Local')
                            ->helperText('O local onde o problema ocorreu.')
                            ->required(),
                        Forms\Components\TextInput::make('contact')
                            ->label('Contato')
                            ->helperText('Coloque alguma forma de contato caso seja necessário, como um telefone ou e-mail.')
                            ->columns(2),
                ])->columns(1)
            ]);
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', true)),
            'inactive' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', false)),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true, true),
                Tables\Columns\TextColumn::make('created_by')
                    ->label('Relator')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('problem')
                    ->label('Problema')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('chamadoCategory.name')
                    ->label('Categoria')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact')
                    ->label('Contato')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('place')
                    ->label('Local')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->label('Alterado por')
                    ->searchable()
                    ->toggleable(true, true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Alterado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true, true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Deletado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true, true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageChamados::route('/'),
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
