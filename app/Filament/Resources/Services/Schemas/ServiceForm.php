<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Paket')->required()->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
            TextInput::make('wifi_name')->label('Nama WiFi'),
            TextInput::make('speed_mbps')->label('Kecepatan')->numeric()->suffix('Mbps')->minValue(1)->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            TextInput::make('sort_order')->label('Urutan')->numeric()->default(1)->required(),
            RichEditor::make('short_description')->label('Deskripsi Singkat')->columnSpanFull(),
            TextInput::make('price')->label('Harga Paket')->numeric()->prefix('Rp')->nullable(),
            TextInput::make('monthly_fee')->label('Biaya Perbulan')->numeric()->prefix('Rp')->nullable(),
            RichEditor::make('description')->label('Deskripsi Lengkap')->columnSpanFull(),
            Toggle::make('is_active')->label('Aktif')->default(true),
        ])->columns(2);
    }
}
