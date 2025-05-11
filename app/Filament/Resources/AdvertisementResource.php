<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvertisementResource\Pages;
use App\Models\Advertisement;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form->schema([
           Select::make('type')
               ->required()
               ->default('image')
               ->options([
                   'image' => 'Image',
                   'video' => 'Video',
                   'text' => 'Text',
               ])
               ->reactive()
               ->afterStateUpdated(fn($state, callable $set) => [
                   $set('image_file', null),
                   $set('video_file', null),
                   $set('text', null),
               ]),

           FileUpload::make('image_file')
               ->label('Upload Image')
               ->directory('advertisements/images')
               ->acceptedFileTypes(['image/jpeg', 'image/png'])
               ->visibility('public')
               ->previewable(true)
               ->visible(fn($get) => $get('type') === 'image'),

           FileUpload::make('video_file')
               ->label('Upload Video')
               ->directory('advertisements/videos')
               ->acceptedFileTypes(['video/mp4', 'video/webm'])
               ->visibility('public')
               ->previewable(true)
               ->downloadable(true)
               ->visible(fn($get) => $get('type') === 'video'),

           Forms\Components\Textarea::make('text')
               ->label('Text Content')
               ->rows(5)
               ->visible(fn($get) => $get('type') === 'text'),

       ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->sortable(),
                TextColumn::make('file')->limit(30),
                TextColumn::make('text')->limit(30),
                TextColumn::make('is_active')->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvertisements::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
        ];
    }
}
