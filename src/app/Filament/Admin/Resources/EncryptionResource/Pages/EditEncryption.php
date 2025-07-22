<?php

namespace App\Filament\Admin\Resources\EncryptionResource\Pages;

use App\Filament\Admin\Resources\EncryptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEncryption extends EditRecord
{
    protected static string $resource = EncryptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
