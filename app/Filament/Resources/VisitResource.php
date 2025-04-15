<?php

namespace App\Filament\Resources;
use Filament\Tables\Actions\Action;

use App\Filament\Resources\VisitResource\Pages;
use App\Models\Visit;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Визиты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('Электронная почта')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Номер телефона')
                    ->tel()
                    ->required(),

                Forms\Components\TextInput::make('address')
                    ->label('Адрес')
                    ->required(),

                Forms\Components\DateTimePicker::make('visit_date')
                    ->label('Дата визита')
                    ->required()
                    ->minDate(now()),

                Forms\Components\TimePicker::make('visit_time')
                    ->label('Время визита')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Электронная почта')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Телефон')
                    ->sortable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Адрес')
                    ->sortable(),

                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Дата визита')
                    ->sortable()
                    ->dateTime('d.m.Y'),

                Tables\Columns\TextColumn::make('visit_time')
                    ->label('Время визита')
                    ->sortable(),
               
            ])
            ->actions([
                // Добавляем кастомное действие
                Action::make('markAsSeen')
                    ->label('Отметить как просмотренный')
                    ->action(function ($record) {
                        // Обновляем поле seen на true
                        $record->update(['seen' => true]);
                    })
                    ->visible(fn ($record) => !$record->seen) // Делаем кнопку видимой только если 'seen' == false
                    ->color('success')
                    ->icon('heroicon-s-eye'),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
