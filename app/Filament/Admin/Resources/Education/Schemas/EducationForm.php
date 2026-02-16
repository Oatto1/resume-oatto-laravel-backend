<?php

namespace App\Filament\Admin\Resources\Education\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            FileUpload::make('image')
            ->image()
            ->directory('education')
            ->required(),

            Section::make('EN English')
            ->schema([
                TextInput::make('school')->label('School (EN)')->required(),
                TextInput::make('degree')->label('Degree (EN)')->required(),
            ]),

            Section::make('🇹🇭 ภาษาไทย')
            ->schema([
                TextInput::make('school_th')->label('โรงเรียน/มหาวิทยาลัย (TH)'),
                TextInput::make('degree_th')->label('ปริญญา (TH)'),
            ])
            ->collapsible(),

            TextInput::make('gpa'),
            TextInput::make('start_year')->required(),
            TextInput::make('end_year')->required(),
        ]);
    }
}
