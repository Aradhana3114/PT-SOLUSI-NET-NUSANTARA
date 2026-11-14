<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Nama Paket')->searchable(),
            TextColumn::make('wifi_name')->label('Nama WiFi')->searchable(),
            TextColumn::make('speed_mbps')->label('Kecepatan')->suffix(' Mbps')->sortable(),
            TextColumn::make('monthly_fee')->label('Biaya Perbulan')->money('IDR', locale: 'id')->sortable(),
            TextColumn::make('price')->label('Price')->money('IDR', locale: 'id')->sortable(),
            TextColumn::make('sort_order')->label('Urutan')->sortable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->defaultSort('sort_order')->recordActions([
            EditAction::make(), DeleteAction::make(),
        ])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
