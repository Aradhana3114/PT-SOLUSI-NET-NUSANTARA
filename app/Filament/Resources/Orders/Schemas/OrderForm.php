<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')->label('Nama Pelanggan')->relationship('user', 'name')->searchable()->preload()->required(),
            TextInput::make('order_number')->required(),
            Select::make('status')->options(['pending' => 'Pending', 'processing' => 'Diproses', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'])->required(),
            Select::make('payment_status')->options(['unpaid' => 'Belum Dibayar', 'paid' => 'Dibayar', 'refunded' => 'Dikembalikan'])->required(),
            FileUpload::make('payment_proof')->label('Bukti Pembayaran')->image()->disk('public')->directory('payment-proofs')->openable()->downloadable(),
            TextInput::make('total_amount')->numeric()->prefix('Rp')->required(),
            TextInput::make('phone')->label('Nomor Telepon')->tel(),
            TextInput::make('address')->label('Alamat Pemasangan')->columnSpanFull(),
            TextInput::make('customer_notes')->label('Catatan Pembeli')->columnSpanFull(),
            TextInput::make('notes')->label('Catatan Admin')->columnSpanFull(),
        ]);
    }
}
