<?php

namespace App\Filament\Admin\Resources\GajiResource\Pages;

use App\Filament\Admin\Resources\GajiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGaji extends CreateRecord
{
    protected static string $resource = GajiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['total_gaji'] = ($data['gaji_pokok'] ?? 0) + ($data['tunjangan'] ?? 0) - ($data['potongan'] ?? 0);
        return $data;
    }
}
