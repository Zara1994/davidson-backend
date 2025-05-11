<?php

namespace App\Filament\Resources\ShowroomSliderResource\Pages;

use App\Filament\Resources\ShowroomSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShowroomSlider extends EditRecord
{
    protected static string $resource = ShowroomSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
