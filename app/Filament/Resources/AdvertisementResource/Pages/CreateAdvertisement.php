<?php

namespace App\Filament\Resources\AdvertisementResource\Pages;

use App\Filament\Resources\AdvertisementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdvertisement extends CreateRecord
{
    protected static string $resource = AdvertisementResource::class;

    protected function getRedirectUrl(): string
    {
        return AdvertisementResource::getUrl('index');

    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['type'] === 'video' && isset($data['video_file'])) {
            $data['file'] = $data['video_file'];
        } elseif ($data['type'] === 'image' && isset($data['image_file'])) {
            $data['file'] = $data['image_file'];
        } else {
            $data['file'] = null;
        }

        unset($data['video_file'], $data['image_file']);
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->mutateFormDataBeforeCreate($data);
    }

}
