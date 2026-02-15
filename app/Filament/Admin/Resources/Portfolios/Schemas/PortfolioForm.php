<?php

namespace App\Filament\Admin\Resources\Portfolios\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\TagsInput;
use App\Helpers\ImageHelper;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('🇬🇧 English')
            ->schema([
                TextInput::make('title')
                ->label('Project Name (EN)')
                ->required(),
                Textarea::make('description')
                ->label('Description (EN)'),
            ]),

            Section::make('🇹🇭 ภาษาไทย')
            ->schema([
                TextInput::make('title_th')
                ->label('ชื่อโปรเจกต์ (TH)'),
                Textarea::make('description_th')
                ->label('คำอธิบาย (TH)'),
            ])
            ->collapsible(),

            TextInput::make('subtitle')
            ->label('Category')
            ->required(),

            Select::make('type')
            ->options([
                'app' => 'Application', // Changed from 'Mobile App'
                'website' => 'Website',
            ])
            // ->reactive() // Removed reactive()
            ->required(),

            TagsInput::make('tech_stack') // Replaced TextInput with TagsInput
            ->required()
            ->columnSpanFull(),

            FileUpload::make('image')
            ->image()
            ->directory('portfolios')
            ->required(),

            TextInput::make('link')
            ->label('Project Link')
            ->url(),

            FileUpload::make('images')
            ->multiple()
            ->image()
            ->disk('public')
            ->directory('portfolios')
            ->saveUploadedFileUsing(fn($file) =>
        ImageHelper::convertToWebpSharp($file, 'portfolios')
        )
            ->columnSpanFull()
            ->visible(fn(Get $get) => $get('type') === 'app')
        ]);
    }
}
