<?php

namespace App\Filament\Admin\Resources\EncryptionResource\Pages;

use App\Filament\Admin\Resources\EncryptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEncryptions extends ListRecords
{
    protected static string $resource = EncryptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
