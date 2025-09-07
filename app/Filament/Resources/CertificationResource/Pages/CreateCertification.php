<?php

namespace App\Filament\Resources\CertificationResource\Pages;

use App\Filament\Resources\CertificationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCertification extends CreateRecord
{
    protected static string $resource = CertificationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['slug'] ?? '')) {
            $data['slug'] = Str::slug((string) ($data['title'] ?? ''));
        }

        return $data;
    }
}
