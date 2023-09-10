<?php

namespace App\Filament\Resources\CardResource\RelationManager;

use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PaymentRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Pagamentos';

    protected static ?string $icon = 'heroicon-o-currency-dollar';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->payments->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pagamento')
                    ->schema([
                        Forms\Components\Select::make('payment_method_id')
                        ->relationship('paymentmethod', 'name')
                        ->label('Método de Pagamento')
                        ->required(),
                    Forms\Components\TextInput::make('value')
                        ->label('Valor')
                        ->default(0)
                        ->required(),
                    Forms\Components\TextInput::make('transshipment')
                        ->label('Troco')
                        ->default(0),
                    ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->label('#')
                    ->alignCenter(),
                TextColumn::make('paymentmethod.name')
                    ->searchable()
                    ->sortable()
                    ->label('Método')
                    ->alignCenter(),
                TextColumn::make('value')
                    ->searchable()
                    ->sortable()
                    ->label('Valor')
                    ->alignCenter(),
                TextColumn::make('transshipment')
                    ->searchable()
                    ->sortable()
                    ->label('Troco')
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Novo pagamento'),
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
                    ->label('Novo pagamento'),
            ]);
        
    }

}