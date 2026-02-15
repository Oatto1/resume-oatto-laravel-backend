<?php

namespace App\Filament\Admin\Resources\AboutMes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;

class AboutMeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
            FileUpload::make('main_image')
            ->label('Profile image')
            ->image()
            ->directory('about-me')
            ->imagePreviewHeight('150')
            ->columnSpanFull(),

            // ===== English =====
            Section::make('🇬🇧 English')
            ->schema([
                TextInput::make('name')->label('Name (EN)')->required(),
                TextInput::make('position')->label('Position (EN)')->required(),
                Textarea::make('description')->label('Description (EN)')->rows(5)->columnSpanFull(),
            ])
            ->columns(2)
            ->columnSpanFull(),

            // ===== Thai =====
            Section::make('🇹🇭 ภาษาไทย')
            ->schema([
                TextInput::make('name_th')->label('ชื่อ (TH)'),
                TextInput::make('position_th')->label('ตำแหน่ง (TH)'),
                Textarea::make('description_th')->label('คำอธิบาย (TH)')->rows(5)->columnSpanFull(),
            ])
            ->columns(2)
            ->columnSpanFull()
            ->collapsible(),

            TextInput::make('email')->email()->required(),
            TextInput::make('phone')->required(),

            TextInput::make('github_link')
            ->url()
            ->columnSpanFull(),

            // ===== Experiences =====
            Repeater::make('experiences')
            ->relationship()
            ->columnSpan(1)
            ->schema([
                FileUpload::make('image')
                ->image()
                ->directory('experiences')
                ->required()
                ->columnSpanFull(),

                TextInput::make('company')->label('Company (EN)')->required(),
                TextInput::make('company_th')->label('บริษัท (TH)'),
                TextInput::make('position')->label('Position (EN)')->required(),
                TextInput::make('position_th')->label('ตำแหน่ง (TH)'),

                DatePicker::make('start_year')
                ->label('Start Year')
                ->displayFormat('Y')
                ->format('Y')
                ->native(false)
                ->closeOnDateSelection()
                ->required(),
                DatePicker::make('end_year')
                ->label('End Year')
                ->displayFormat('Y')
                ->format('Y')
                ->native(false)
                ->closeOnDateSelection(),

                Textarea::make('description')
                ->label('Description (EN)')
                ->columnSpanFull(),
                Textarea::make('description_th')
                ->label('คำอธิบาย (TH)')
                ->columnSpanFull(),
            ])
            ->collapsible(),

            // ===== Education =====
            Repeater::make('education')
            ->relationship()
            ->columnSpan(1)
            ->schema([
                FileUpload::make('image')
                ->image()
                ->directory('education')
                ->required()
                ->columnSpanFull(),

                TextInput::make('school')->label('School (EN)')->required(),
                TextInput::make('school_th')->label('โรงเรียน/มหาวิทยาลัย (TH)'),
                TextInput::make('degree')->label('Degree (EN)')->required(),
                TextInput::make('degree_th')->label('ปริญญา (TH)'),

                DatePicker::make('start_year')
                ->label('Start Year')
                ->displayFormat('Y')
                ->format('Y')
                ->native(false)
                ->closeOnDateSelection()
                ->required(),
                DatePicker::make('end_year')
                ->label('End Year')
                ->displayFormat('Y')
                ->format('Y')
                ->native(false)
                ->closeOnDateSelection()
                ->required(),

                TextInput::make('gpa')
                ->columnSpanFull(),
            ])
            ->collapsible(),
        ]);
    }
}
