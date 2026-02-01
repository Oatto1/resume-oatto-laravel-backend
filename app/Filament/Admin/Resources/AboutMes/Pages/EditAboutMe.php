<?php

namespace App\Filament\Admin\Resources\AboutMes\Pages;

use App\Filament\Admin\Resources\AboutMes\AboutMeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAboutMe extends EditRecord
{
    protected static string $resource = AboutMeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
