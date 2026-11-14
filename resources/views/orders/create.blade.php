@extends('layouts.app')
@section('title', 'Pesan Paket - '.$setting->site_name)

@section('content')
<section class="max-w-3xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-semibold text-navy">Form Pemesanan Paket Layanan</h1>
    <p class="mt-2 text-gray-600">Lengkapi data berikut untuk memesan paket <strong>{{ $service->name }}</strong>.</p>

    @if($errors->any())
        <div class="mt-6 border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="mt-8 border bg-[#dedede] p-6 shadow-sm">
        <div class="mb-6 border-b pb-4">
            <p class="text-sm text-gray-500">Paket dipilih</p>
            <p class="text-xl font-semibold text-navy">{{ $service->name }}</p>
            <p class="mt-1 font-medium text-brand">Rp {{ number_format($service->monthly_fee ?: $service->price, 0, ',', '.') }}</p>
        </div>

        <form method="POST" action="{{ route('orders.store', $service) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="mb-1 block text-sm font-medium">Nama Lengkap</label>
                <input id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full border px-3 py-2">
            </div>
            <div>
                <label for="phone" class="mb-1 block text-sm font-medium">Nomor WhatsApp / Telepon</label>
                <input id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required class="w-full border px-3 py-2">
            </div>
            <div>
                <label for="address" class="mb-1 block text-sm font-medium">Alamat Pemasangan</label>
                <textarea id="address" name="address" rows="4" required class="w-full border px-3 py-2">{{ old('address', auth()->user()->address) }}</textarea>
            </div>
            <div class="border border-white bg-white p-4">
                <p class="text-sm font-semibold text-navy">Pembayaran melalui Bank BCA</p>
                <p class="mt-2 text-sm text-gray-700">Silakan transfer sesuai total pembayaran ke rekening berikut:</p>
                <p class="mt-2 text-lg font-bold tracking-wide text-navy">BCA 1234567890</p>
                <p class="text-sm text-gray-600">a.n. PT Solusi Net Nusantara</p>
                <p class="mt-2 text-xs text-red-400 font-semibold">Gunakan rekening tujuan di atas dan unggah bukti transfer setelah pembayaran.</p>
            </div>
            <div>
                <label for="payment_proof" class="mb-1 block text-sm font-medium">Bukti Pembayaran</label>
                <input id="payment_proof" name="payment_proof" type="file" accept="image/jpeg,image/png,image/webp" required class="w-full border bg-white px-3 py-2">
                <p class="mt-1 text-xs text-gray-500">Upload foto bukti pembayaran (JPG, PNG, atau WEBP; maksimal 5 MB).</p>
            </div>
            <div>
                <label for="customer_notes" class="mb-1 block text-sm font-medium">Catatan Tambahan <span class="font-normal text-gray-400">(opsional)</span></label>
                <textarea id="customer_notes" name="customer_notes" rows="3" class="w-full border px-3 py-2">{{ old('customer_notes') }}</textarea>
            </div>
            <button type="submit" class="w-full bg-brand px-4 py-3 font-semibold text-white">Kirim Pesanan</button>
        </form>
    </div>
</section>
@endsection
