<?php

namespace App\Filament\Admin\Resources\Portfolios\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Utilities\Get;
use App\Helpers\ImageHelper;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->label('Project Name')
                ->required(),

            TextInput::make('subtitle')
                ->label('Category')
                ->required(),

            Select::make('type')
                ->options([
                    'app' => 'Mobile App',
                    'website' => 'Website',
                ])
                ->reactive()
                ->required(),

            TextInput::make('tech_stack')
                ->label('Tech Stack')
                ->placeholder('Flutter, Laravel')
                ->required(),

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
                ->saveUploadedFileUsing(fn ($file) =>
                    ImageHelper::convertToWebpSharp($file, 'portfolios')
                )
                ->columnSpanFull()
                ->visible(fn (Get $get) => $get('type') === 'app')
        ]);
    }
}
