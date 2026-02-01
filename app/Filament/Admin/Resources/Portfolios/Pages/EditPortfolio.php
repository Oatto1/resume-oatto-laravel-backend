<?php

namespace App\Filament\Admin\Resources\Portfolios\Pages;

use App\Filament\Admin\Resources\Portfolios\PortfolioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPortfolio extends EditRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['images'] = $this->record->images->pluck('images')->toArray();
        return $data;
    }

    protected function afterSave(): void
    {
        $state = $this->form->getState();

        // ถ้า field images ไม่ถูกแตะเลย → ไม่ต้องทำอะไร
        if (! array_key_exists('images', $state)) {
            return;
        }

        $files = $state['images'] ?? [];

        // ลบของเก่าก่อนเสมอ (เพราะ user แตะ field นี้แล้ว)
        $this->record->images()->delete();

        // ถ้ามีไฟล์ใหม่ → insert
        foreach ($files as $file) {
            $this->record->images()->create([
                'images' => $file,
            ]);
        }
    }
}
