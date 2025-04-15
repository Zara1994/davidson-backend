<?php

namespace App\Filament\Resources\PrоjectResource\Pages;

use App\Filament\Resources\PrоjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrоject extends EditRecord
{
    protected static string $resource = PrоjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
