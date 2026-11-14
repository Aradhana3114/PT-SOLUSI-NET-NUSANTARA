<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->disk('public')->label('Gambar'),
            TextColumn::make('title')->label('Judul Kegiatan')->searchable(),
            TextColumn::make('sort_order')->label('Urutan')->sortable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->defaultSort('sort_order')->recordActions([
            EditAction::make(), DeleteAction::make(),
        ])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
