<?php

namespace App\Filament\Admin\Resources\Experiences;

use App\Filament\Admin\Resources\Experiences\Pages\CreateExperience;
use App\Filament\Admin\Resources\Experiences\Pages\EditExperience;
use App\Filament\Admin\Resources\Experiences\Pages\ListExperiences;
use App\Filament\Admin\Resources\Experiences\Schemas\ExperienceForm;
use App\Filament\Admin\Resources\Experiences\Tables\ExperiencesTable;
use App\Models\Experience;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = Experience::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Experience';

    public static function form(Schema $schema): Schema
    {
        return ExperienceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExperiencesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExperiences::route('/'),
            'create' => CreateExperience::route('/create'),
            'edit' => EditExperience::route('/{record}/edit'),
        ];
    }
}
