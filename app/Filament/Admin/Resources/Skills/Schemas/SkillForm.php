<?php

namespace App\Filament\Admin\Resources\Skills\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
            ->label('Skill Name (EN)')
            ->required(),

            TextInput::make('title_th')
            ->label('ชื่อทักษะ (TH)'),

            FileUpload::make('image')
            ->image()
            ->directory('skills')
            ->required(),
        ]);
    }
}
