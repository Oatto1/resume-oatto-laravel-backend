<?php

namespace App\Filament\Admin\Resources\Experiences\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

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
                TextInput::make('company')->required(),
                TextInput::make('position')->required(),

                TextInput::make('start_year')->required(),
                TextInput::make('end_year')->placeholder('Now'),

                Textarea::make('description')->rows(3),
            ]);
    }
}
