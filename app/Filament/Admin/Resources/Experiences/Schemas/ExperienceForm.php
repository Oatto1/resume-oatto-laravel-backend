<?php

namespace App\Filament\Admin\Resources\Experiences\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            FileUpload::make('image')
            ->image()
            ->directory('experiences')
            ->required(),

            Section::make('🇬🇧 English')
            ->schema([
                TextInput::make('company')->label('Company (EN)')->required(),
                TextInput::make('position')->label('Position (EN)')->required(),
                Textarea::make('description')->label('Description (EN)')->rows(3),
            ]),

            Section::make('🇹🇭 ภาษาไทย')
            ->schema([
                TextInput::make('company_th')->label('บริษัท (TH)'),
                TextInput::make('position_th')->label('ตำแหน่ง (TH)'),
                Textarea::make('description_th')->label('คำอธิบาย (TH)')->rows(3),
            ])
            ->collapsible(),

            TextInput::make('start_year')->required(),
            TextInput::make('end_year')->placeholder('Now'),
        ]);
    }
}
