<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),

                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge(),

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
