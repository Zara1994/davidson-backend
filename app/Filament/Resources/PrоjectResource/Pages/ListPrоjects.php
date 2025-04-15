<?php

namespace App\Filament\Resources\PrоjectResource\Pages;

use App\Filament\Resources\PrоjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrоjects extends ListRecords
{
    protected static string $resource = PrоjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
