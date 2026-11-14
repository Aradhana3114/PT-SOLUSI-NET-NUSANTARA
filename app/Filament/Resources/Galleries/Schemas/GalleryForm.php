<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Filament\Support\ImageUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('Judul Kegiatan')->required(),
            TextInput::make('sort_order')->label('Urutan')->numeric()->default(1)->required(),
            Textarea::make('description')->label('Deskripsi')->columnSpanFull(),
            ImageUpload::make('image', 'galleries')->label('Gambar Gallery')->required(),
            Toggle::make('is_active')->label('Aktif')->default(true),
        ])->columns(2);
    }
}
