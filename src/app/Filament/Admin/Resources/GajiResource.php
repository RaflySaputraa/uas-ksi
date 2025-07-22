<?php

namespace App\Filament\Admin\Resources;

use App\Models\Gaji;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Get;
use Filament\Forms\Set;

class GajiResource extends Resource
{
    protected static ?string $model = Gaji::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Gaji';
    protected static ?string $pluralLabel = 'Gaji';
    protected static ?string $label = 'Gaji';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('karyawan_id')
                    ->label('Nama Karyawan')
                    ->relationship('karyawan', 'nama')
                    ->required(),

                TextInput::make('gaji_pokok')
                    ->label('Gaji Pokok')
                    ->prefix('Rp')
                    ->numeric()
                    ->required()
                    ->live(debounce: 300),

                TextInput::make('tunjangan')
                    ->label('Tunjangan')
                    ->prefix('Rp')
                    ->numeric()
                    ->default(0)
                    ->live(debounce: 300),

                TextInput::make('potongan')
                    ->label('Potongan')
                    ->prefix('Rp')
                    ->numeric()
                    ->default(0)
                    ->live(debounce: 300),

                Placeholder::make('total_gaji_display')
                    ->label('Total Gaji')
                    ->content(function (Get $get) {
                        $total = ($get('gaji_pokok') ?? 0) + ($get('tunjangan') ?? 0) - ($get('potongan') ?? 0);
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('karyawan.nama')->label('Karyawan'),
                TextColumn::make('gaji_pokok')->money('IDR', true)->label('Gaji Pokok'),
                TextColumn::make('tunjangan')->money('IDR', true),
                TextColumn::make('potongan')->money('IDR', true),
                TextColumn::make('total_gaji')->money('IDR', true),
                TextColumn::make('created_at')->dateTime()->label('Tanggal'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\GajiResource\Pages\ListGajis::route('/'),
            'create' => \App\Filament\Admin\Resources\GajiResource\Pages\CreateGaji::route('/create'),
            'edit' => \App\Filament\Admin\Resources\GajiResource\Pages\EditGaji::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with('karyawan');
    }

    // Hitung total_gaji sebelum simpan
    public static function beforeCreate($record)
    {
        $record->total_gaji = ($record->gaji_pokok ?? 0) + ($record->tunjangan ?? 0) - ($record->potongan ?? 0);
    }

    public static function beforeUpdate($record)
    {
        $record->total_gaji = ($record->gaji_pokok ?? 0) + ($record->tunjangan ?? 0) - ($record->potongan ?? 0);
    }
}
