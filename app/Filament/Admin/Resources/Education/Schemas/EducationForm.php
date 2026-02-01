<?php

namespace App\Filament\Admin\Resources\Education\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

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
                TextInput::make('school')->required(),
                TextInput::make('degree')->required(),
                TextInput::make('gpa'),

                TextInput::make('start_year')->required(),
                TextInput::make('end_year')->required(),
            ]);
    }
}
