@extends('layouts.app')

@section('content')
@php($wa = 'https://wa.me/' . preg_replace('/\D/', '', $setting->phone ?? ''))

<section class="relative flex min-h-[calc(100vh-70px)] items-center overflow-hidden bg-slate-900 text-white">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-blue-950/80 to-blue-900/40"></div>
    <div class="relative max-w-6xl mx-auto w-full px-4 py-15 text-center">
        <p class="text-sm mb-3 tracking-wide text-cyan-200">{{ $setting->site_name }}</p>
        <h1 class="text-4xl md:text-5xl font-semibold leading-tight">WiFi Cepat dan Stabil<br>Untuk Kebutuhan Anda</h1>
        <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-slate-200">Nikmati paket internet WiFi berkualitas untuk rumah, keluarga, dan bisnis dengan koneksi stabil serta dukungan teknisi yang responsif.</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-12 items-center bg-[#f5f3ef]">
    <div class="relative">
        <div class="absolute -right-3 -bottom-3 w-full h-full bg-brand"></div>
        <img src="{{ $setting->about_image ? asset('storage/' . $setting->about_image) : 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1200&q=85' }}" alt="Tim bekerja dengan teknologi" class="relative h-80 w-full object-cover">
        <div class="absolute bottom-4 left-4 bg-[#dedede]/95 px-4 py-3 shadow-lg">
            <p class="text-xs font-medium text-navy">Internet tanpa batas</p>
            <p class="text-[11px] text-gray-500">Untuk rumah dan bisnis Anda</p>
        </div>
    </div>
    <div>
        <h2 class="text-3xl font-light mb-6">Kenapa Memilih Paket WiFi Kami?</h2>
        <ul class="space-y-2 text-sm">
            @foreach(['Koneksi cepat dan stabil.', 'Pilihan paket sesuai kebutuhan.', 'Harga bulanan transparan.', 'Cocok untuk rumah dan bisnis.', 'Instalasi rapi oleh teknisi.', 'Dukungan pelanggan responsif.'] as $item)
                <li><span class="text-brand">✓</span> {{ $item }}</li>
            @endforeach
        </ul>
        <a href="{{ route('profile') }}" class="inline-block mt-8 border border-brand text-brand px-5 py-2 text-xs hover:bg-brand hover:text-white">Tentang Kami</a>
    </div>
</section>

@if($services->isNotEmpty())
<section id="jasa" class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold mb-8">Pilihan Paket WiFi</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
            <article class="flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-[#dedede] shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="bg-gradient-to-br from-#dedede to-slate-700 px-6 py-6 text-black">
                    <h3 class="mt-4 text-xl font-semibold">{{ $service->name }}</h3>
                </div>
                <div class="flex flex-1 flex-col p-6">
                    @if($service->speed_mbps)<p class="text-4xl font-semibold text-brand">{{ $service->speed_mbps }} <span class="text-lg font-medium text-gray-500">Mbps</span></p>@endif
                    @if($service->monthly_fee)<p class="mt-3 text-lg font-semibold text-navy">Rp {{ number_format($service->monthly_fee, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ bulan</span></p>@elseif($service->price)<p class="mt-3 text-lg font-semibold text-navy">Rp {{ number_format($service->price, 0, ',', '.') }}</p>@endif
                    <div class="mt-4 text-sm leading-relaxed text-gray-600">{!! $service->short_description !!}</div>
                    <div class="mt-auto pt-6">
                        @auth
                            <a href="{{ route('orders.create', $service) }}" class="block w-full rounded-md bg-brand px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-orange-600">Pesan Paket</a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full rounded-md bg-brand px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-orange-600">Login Untuk Pilih Layanan</a>
                        @endauth
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endif

@if($galleries->isNotEmpty())
<section id="gallery" class="bg-slate-50 py-16">
    <div class="max-w-6xl mx-auto px-4"><h2 class="text-3xl font-bold mb-8">Gallery</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($galleries as $gallery)
                <figure class="overflow-hidden bg-[#dedede] shadow-sm"><img src="{{ str_starts_with($gallery->image, 'http') ? $gallery->image : asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="h-48 w-full object-cover"><figcaption class="p-3"><h2 class="text-sm font-medium text-navy">{{ $gallery->title }}</h2>@if($gallery->description)<p class="mt-1 text-sm text-gray-600">{{ $gallery->description }}</p>@endif</figcaption></figure>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="relative overflow-hidden bg-navy text-white">
    <img src="{{ $setting->cta_image ? asset('storage/' . $setting->cta_image) : 'https://images.unsplash.com/photo-1551703599-6b3e8379aa8c?auto=format&fit=crop&w=1800&q=85' }}" alt="Teknologi jaringan dan koneksi digital" class="absolute inset-0 h-full w-full object-cover opacity-20">
    <div class="relative max-w-6xl mx-auto px-4 py-16 flex flex-wrap items-center justify-between gap-6">
        <div class="max-w-xl">
            <h3 class="text-3xl font-light mb-3">Paket WiFi sesuai kebutuhan Anda</h3>
            <p class="text-sm text-slate-300">Pilih {{ $setting->site_name }} untuk mendapatkan koneksi internet yang cepat, stabil, dan didukung layanan teknisi yang siap membantu.</p>
        </div>
        <a href="{{ $wa }}" target="_blank" class="bg-brand rounded-full px-8 py-3 font-medium">{{ $setting->phone }}</a>
    </div>
</section>
@endsection
