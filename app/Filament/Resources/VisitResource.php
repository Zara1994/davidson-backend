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
    protected static ?string $navigationLabel = 'Visits';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Phone number')
                    ->tel()
                    ->required(),

                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->required(),

                Forms\Components\DateTimePicker::make('visit_date')
                    ->label('Visit Date')
                    ->required()
                    ->minDate(now()),

                Forms\Components\TimePicker::make('visit_time')
                    ->label('Visit Time')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone number')
                    ->sortable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->sortable(),

                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Visit date')
                    ->sortable()
                    ->dateTime('d.m.Y'),

                Tables\Columns\TextColumn::make('visit_time')
                    ->label('Visit time')
                    ->sortable(),

            ])
            ->actions([
                // Добавляем кастомное действие
                Action::make('markAsSeen')
                    ->action(function ($record) {
                        // Обновляем поле seen на true
                        $record->update(['seen' => true]);
                    })
                    ->visible(fn ($record) => !$record->seen) // Делаем кнопку видимой только если 'seen' == false
                    ->color('success')
                    ->icon('heroicon-s-eye'),
                Tables\Actions\ViewAction::make(),
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
