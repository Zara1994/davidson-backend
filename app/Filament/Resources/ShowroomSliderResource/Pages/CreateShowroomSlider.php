<?php

namespace App\Filament\Resources\ShowroomSliderResource\Pages;

use App\Filament\Resources\ShowroomSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShowroomSlider extends CreateRecord
{
    protected static string $resource = ShowroomSliderResource::class;

    protected function getRedirectUrl(): string
    {
        return ShowroomSliderResource::getUrl('index');

    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Проверяем, что файлы передаются корректно
        if ($data['type'] === 'video' && isset($data['video_file'])) {
            $data['file'] = $data['video_file'];
        } elseif ($data['type'] === 'image' && isset($data['image_file'])) {
            $data['file'] = $data['image_file'];
        } else {
            $data['file'] = null;  // Если нет файла, присваиваем null
        }

        unset($data['video_file'], $data['image_file']);  // Убираем временные файлы
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // То же самое для сохранения
        if ($data['type'] === 'video' && isset($data['video_file'])) {
            $data['file'] = $data['video_file'];
        } elseif ($data['type'] === 'image' && isset($data['image_file'])) {
            $data['file'] = $data['image_file'];
        } else {
            $data['file'] = null;  // Если нет файла, присваиваем null
        }

        unset($data['video_file'], $data['image_file']);  // Убираем временные файлы
        return $data;
    }
}
