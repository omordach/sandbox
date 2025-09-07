<?php

namespace App\Filament\Resources\CertificationResource\Pages;

use App\Filament\Resources\CertificationResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditCertification extends EditRecord
{
    protected static string $resource = CertificationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['slug'] ?? '')) {
            $data['slug'] = Str::slug((string) ($data['title'] ?? ''));
        }

        return $data;
    }
}
