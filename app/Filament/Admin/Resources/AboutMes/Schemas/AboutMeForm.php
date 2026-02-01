<?php

namespace App\Filament\Admin\Resources\AboutMes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class AboutMeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // 👈 ทั้งฟอร์มแบ่ง 2 คอลัมน์
            ->components([
                FileUpload::make('main_image')
                    ->label('Profile image')
                    ->image()
                    ->directory('about-me')
                    ->imagePreviewHeight('150')
                    ->columnSpanFull(),

                TextInput::make('name')->required(),
                TextInput::make('position')->required(),

                TextInput::make('email')->email()->required(),
                TextInput::make('phone')->required(),

                TextInput::make('github_link')
                    ->url()
                    ->columnSpanFull(),

                // ===== Experiences (ฝั่งซ้าย) =====
                Repeater::make('experiences')
                    ->relationship()
                    ->columnSpan(1) // 👈 กินครึ่งซ้าย
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('experiences')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('company')->required(),
                        TextInput::make('position')->required(),

                        DatePicker::make('start_year')
                            ->label('Start Year')
                            ->displayFormat('Y')   // แสดงแค่ปี
                            ->format('Y')          // บันทึกเป็นปี
                            ->native(false)        // ใช้ calendar ของ Filament
                            ->closeOnDateSelection()
                            ->required(),
                        DatePicker::make('end_year')
                            ->label('End Year')
                            ->displayFormat('Y')   // แสดงแค่ปี
                            ->format('Y')          // บันทึกเป็นปี
                            ->native(false)        // ใช้ calendar ของ Filament
                            ->closeOnDateSelection(),

                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                // ===== Education (ฝั่งขวา) =====
                Repeater::make('education')
                    ->relationship()
                    ->columnSpan(1) // 👈 กินครึ่งขวา
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('education')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('school')->required(),
                        TextInput::make('degree')->required(),

                        DatePicker::make('start_year')
                            ->label('Start Year')
                            ->displayFormat('Y')   // แสดงแค่ปี
                            ->format('Y')          // บันทึกเป็นปี
                            ->native(false)        // ใช้ calendar ของ Filament
                            ->closeOnDateSelection()
                            ->required(),
                        DatePicker::make('end_year')
                            ->label('End Year')
                            ->displayFormat('Y')   // แสดงแค่ปี
                            ->format('Y')          // บันทึกเป็นปี
                            ->native(false)        // ใช้ calendar ของ Filament
                            ->closeOnDateSelection()
                            ->required(),

                        TextInput::make('gpa')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
