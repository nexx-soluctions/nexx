<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Filament\Resources\CardResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCard extends CreateRecord
{
    protected static string $resource = CardResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['hash_id'] = $this->generateHashId($data['identity']);

        return $data;
    }

    private function generateHashId(string $identy): string
    {
        return hash('sha256', date('Y-m-d-H:i:s.u') . $identy);
    }
}
