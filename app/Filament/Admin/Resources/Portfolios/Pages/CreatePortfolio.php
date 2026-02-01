<?php

namespace App\Filament\Admin\Resources\Portfolios\Pages;

use App\Filament\Admin\Resources\Portfolios\PortfolioResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function afterCreate(): void
    {
        $files = $this->form->getState()['images'] ?? [];

        logger($files);

        foreach ($files as $file) {
            $this->record->images()->create([
                'images' => $file, // 👈 ใช้ images
            ]);
        }
    }
}
