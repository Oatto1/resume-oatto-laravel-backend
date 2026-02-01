<?php

namespace App\Filament\Admin\Resources\Portfolios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PortfoliosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->square(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('subtitle')
                    ->label('Category')
                    ->searchable(),

                BadgeColumn::make('type')
                    ->colors([
                        'mobile' => 'primary',
                        'website' => 'success',
                    ]),

                TextColumn::make('tech_stack')
                    ->label('Tech Stack'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                //
            ])

            // ===== ปุ่มต่อ 1 แถว =====
            ->recordActions([
                // 👁 View = ทุก role ดูได้
                ViewAction::make(),

                // ✏️ Edit = เฉพาะ super-admin
                EditAction::make()
                    ->visible(fn () =>
                        auth()->user()->hasRole('super-admin')
                    ),
            ])

            // ===== ปุ่มด้านบน (bulk) =====
            ->toolbarActions([
                BulkActionGroup::make([
                    // 🗑 Bulk delete = เฉพาะ super-admin
                    DeleteBulkAction::make()
                        ->visible(fn () =>
                            auth()->user()->hasRole('super-admin')
                        ),
                ]),
            ]);
    }
}
