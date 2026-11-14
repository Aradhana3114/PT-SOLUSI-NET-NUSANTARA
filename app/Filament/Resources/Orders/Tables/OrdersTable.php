<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('order_number')->label('Nomor Pesanan')->searchable(),
            TextColumn::make('user.name')->label('Nama Pelanggan')->searchable(),
            TextColumn::make('total_amount')->label('Total')->money('IDR', locale: 'id')->sortable(),
            TextColumn::make('status')->label('Status')->badge(),
            TextColumn::make('payment_status')->label('Pembayaran')->badge(),
            ImageColumn::make('payment_proof')->label('Bukti PEmbayaran')->disk('public'),
            TextColumn::make('customer_notes')->label('Catatan Pembeli')->limit(40)->wrap(),
            TextColumn::make('created_at')->label('Tanggal Pembelian')->dateTime('d M Y H:i')->sortable(),
        ])->defaultSort('created_at', 'desc')->recordActions([
            EditAction::make(),
        ])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
