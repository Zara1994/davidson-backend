<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Имя')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('message')->label('Сообщение')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Дата')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Просмотр')
                    ->modalHeading(fn ($record) => 'Сообщение от ' . $record->name)
                    ->modalContent(fn ($record) => new HtmlString('
                    <div class="space-y-4 p-4">
                        <div><strong>Имя:</strong><br>' . e($record->name) . '</div>
                        <div><strong>Email:</strong><br>' . e($record->email) . '</div>
                        <div>
                            <strong>Сообщение:</strong><br>
                            <div class="max-h-64 overflow-y-auto p-3 bg-gray-100 dark:bg-gray-800 rounded-md text-sm leading-relaxed">'
                        . nl2br(e($record->message)) .
                        '</div>
                        </div>
                    </div>
                ')),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // массовое удаление
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),


        ];
    }

}
