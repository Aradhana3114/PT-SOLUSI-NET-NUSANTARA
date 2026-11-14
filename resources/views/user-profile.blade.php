@extends('layouts.app')
@section('title', 'Profil Saya - '.$setting->site_name)

@section('content')
<section class="max-w-2xl mx-auto px-4 py-12">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-3xl font-semibold text-navy">Profil Saya</h1>
        @unless($hasSubscription)
            <a href="{{ route('services') }}" class="bg-brand px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-600">Langganan</a>
        @endunless
    </div>
    @if(session('success'))
        <div class="mt-6 border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if(session('info'))
        <div class="mt-6 border border-blue-200 bg-blue-50 p-4 text-sm text-blue-700">
            {{ session('info') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mt-6 border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.profile.update') }}" class="mt-8 space-y-5 border bg-[#dedede] p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email</label>
            <input id="email" type="email" value="{{ auth()->user()->email }}" readonly class="w-full cursor-not-allowed border bg-gray-100 px-3 py-2 text-gray-500">
        </div>
        <div>
            <label for="name" class="mb-1 block text-sm font-medium">Nama Lengkap</label>
            <input id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full border px-3 py-2">
        </div>
        <div>
            <label for="phone" class="mb-1 block text-sm font-medium">Nomor Telepon / WhatsApp</label>
            <input id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required class="w-full border px-3 py-2">
        </div>
        <div>
            <label for="address" class="mb-1 block text-sm font-medium">Alamat</label>
            <textarea id="address" name="address" rows="4" required class="w-full border px-3 py-2">{{ old('address', auth()->user()->address) }}</textarea>
        </div>
        <button type="submit" class="w-full bg-brand px-4 py-3 font-semibold text-white">Simpan Profil</button>
    </form>

    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-navy">Riwayat Pembelian</h2>
        @forelse($orders as $order)
            <div class="mt-4 border bg-[#dedede] p-5 shadow-sm">
                <div class="flex flex-wrap items-start justify-between gap-3 border-b pb-3">
                    <div>
                        <p class="font-semibold text-navy">{{ $order->order_number }}</p>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-brand">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        <p class="mt-1 text-xs uppercase text-gray-500">{{ $order->status }} · {{ $order->payment_status }}</p>
                    </div>
                </div>
                <div class="mt-3 space-y-1 text-sm text-gray-600">
                    @foreach($order->items as $item)
                        <p>{{ $item->service_name }} × {{ $item->quantity }} — Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="mt-4 border bg-[#dedede] p-5 text-sm text-gray-500">Belum ada riwayat pembelian.</div>
        @endforelse
    </div>
</section>
@endsection
