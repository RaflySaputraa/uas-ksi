<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EncryptionResource\Pages;
use App\Models\Encryption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class EncryptionResource extends Resource
{
    protected static ?string $model = Encryption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('original_text')
                    ->label('Original Text')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('encrypted_text', encrypt($state));
                    }),

                Textarea::make('encrypted_text')
                    ->label('Encrypted Text')
                    ->disabled()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),
                TextColumn::make('original_text')->limit(30)->label('Original'),
                TextColumn::make('encrypted_text')->limit(30)->label('Encrypted'),
                TextColumn::make('created_at')->since()->label('Created'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEncryptions::route('/'),
            'create' => Pages\CreateEncryption::route('/create'),
            'edit' => Pages\EditEncryption::route('/{record}/edit'),
        ];
    }
}
