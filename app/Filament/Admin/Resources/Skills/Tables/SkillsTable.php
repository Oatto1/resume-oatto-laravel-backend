<?php

namespace App\Filament\Admin\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Icon')
                    ->square(),

                TextColumn::make('title')
                    ->label('Skill')
                    ->searchable(),
            ])

            ->filters([
                //
            ])

            // ปุ่มต่อ 1 แถว
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])

            // ปุ่มด้านบน (bulk delete)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
