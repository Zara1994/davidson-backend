<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrоjectResource\Pages;
use App\Filament\Resources\PrоjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrоjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Textarea::make('description')->required(),
                FileUpload::make('photo_before')
                    ->image()
                    ->directory('projects') // ✅ сохраняем в "categories"
                    ->disk('public')
                    ->visibility('public'),
                FileUpload::make('photo_after')
                    ->image()
                    ->directory('projects') // ✅ сохраняем в "categories"
                    ->disk('public')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->limit(),

                Tables\Columns\ImageColumn::make('photo_before')
                    ->label('Изображение до')
                    ->disk('public'),
                Tables\Columns\ImageColumn::make('photo_after')
                    ->label('Изображение после')
                    ->disk('public'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPrоjects::route('/'),
            'create' => Pages\CreatePrоject::route('/create'),
            'edit' => Pages\EditPrоject::route('/{record}/edit'),
        ];
    }
}
