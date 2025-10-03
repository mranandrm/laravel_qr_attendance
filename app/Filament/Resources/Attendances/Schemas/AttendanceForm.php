<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('event_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
