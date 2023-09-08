<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChamadoResource\Pages;
use App\Filament\Widgets\BlogPostsChart;
use App\Models\Chamado;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Relations\Relation;

class ChamadoResource extends Resource
{
    protected static ?string $model = Chamado::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    // protected static ?string $activeNavigationIcon = 'heroicon-s-wrench';

    protected static ?string $navigationLabel = 'Chamados';

    protected static ?string $navigationGroup = 'Chamados';

    protected static ?string $recordTitleAttribute = 'problema';

    protected static int $globalSearchResoltsLimit = 20;
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Criado por' => $record->created_by,
        ]; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Chamado')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('problema')
                                ->required()
                                ->helperText('Problema do chamado.')
                        ])->columns(2)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('problema')->label('Problema')
                    ->searchable(),
                TextColumn::make('created_by')->label('Criado por')
                    ->toggleable(),
                TextColumn::make('created_at')->label('Criado em')->date('m/d/Y'),
            ])
            ->filters([
                SelectFilter::make('problema')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
            // ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes());
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
            'index' => Pages\ListChamados::route('/'),
            'create' => Pages\CreateChamado::route('/create'),
            'edit' => Pages\EditChamado::route('/{record}/edit'),
        ];
    }    
}
