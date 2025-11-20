<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowroomSliderResource\Pages;
use App\Filament\Resources\ShowroomSliderResource\RelationManagers;
use App\Models\ShowroomSlider;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class ShowroomSliderResource extends Resource
{
    protected static ?string $model = ShowroomSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Поле для выбора типа
            Select::make('type')
                ->required()
                ->default('image')
                ->options([
                    'image' => 'Image',
                    'video' => 'Video',
                ])
                ->reactive()  // Чтобы форма обновлялась при изменении типа
                ->afterStateUpdated(fn($state, callable $set) => [
                    // Обнуляем файлы при изменении типа
                    $set('image_file', null),
                    $set('video_file', null),
                ]),

            // Поле для загрузки изображения
            FileUpload::make('image_file')
                ->label('Upload Image')
                ->disk('public')                // <--- обязательно!
                ->directory('showroom/images')
                ->acceptedFileTypes(['image/jpeg', 'image/png'])
                ->visibility('public')
                ->previewable(true)
                ->visible(fn($get) => $get('type') === 'image'), // Показывать только если type == image

            // Поле для загрузки видео
            FileUpload::make('video_file')
                ->label('Upload Video')
                ->disk('public')                // <--- обязательно!
                ->directory('showroom/videos')
//                ->acceptedFileTypes(['*.mp4', '*.webm'])
                ->acceptedFileTypes(['video/mp4', 'video/webm'])
                ->visibility('public')
                ->previewable(true)
                ->downloadable(true)
                ->visible(fn($get) => $get('type') === 'video'), // Показывать только если type == video


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->sortable(),
                TextColumn::make('file')->label('File Path')->limit(30),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListShowroomSliders::route('/'),
            'create' => Pages\CreateShowroomSlider::route('/create'),
        ];
    }
}
