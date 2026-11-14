
@extends('layouts.app')
@section('title', 'Layanan - '.$setting->site_name)

@section('content')
<section class="bg-gradient-to-r from-slate-700 to-blue-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-20 text-center">
        <p class="text-sm font-medium uppercase tracking-[0.2em] text-blue-200">Produk & Layanan</p>
        <h1 class="mt-3 text-4xl font-light">Solusi Koneksi dan Jaringan</h1>
        <p class="mx-auto mt-3 max-w-2xl text-sm text-slate-200">Layanan wifi untuk rumah, kantor, dan bisnis.</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-9 py-12">
    <h2 class="mt-14 text-2xl font-semibold text-navy">Pilihan Paket wifi</h2>
    <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
            <article class="flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-[#dedede] shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="px-6 py-6 text-navy">
                    <h2 class="mt-4 text-xl font-semibold">{{ $service->name }}</h2>
                    @if($service->wifi_name)
                        <p class="mt-1 text-sm font-bold text-gray-600">{{ $service->wifi_name }}</p>
                    @endif
                </div>
                <div class="flex flex-1 flex-col p-6">
                    @if($service->speed_mbps)
                        <p class="text-4xl font-semibold text-brand">{{ $service->speed_mbps }} <span class="text-lg font-medium text-gray-500">Mbps</span></p>
                    @endif
                    @if($service->monthly_fee)
                        <p class="mt-3 text-lg font-semibold text-navy">Rp {{ number_format($service->monthly_fee, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ bulan</span></p>
                    @elseif($service->price)
                        <p class="mt-3 text-lg font-semibold text-navy">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                    @else
                        <p class="mt-3 text-sm font-medium text-brand">Hubungi kami untuk harga</p>
                    @endif
                    <div class="mt-4 text-sm leading-relaxed text-gray-600">{!! $service->short_description !!}</div>
                    <div class="mt-auto pt-6">
                        @auth
                            <a href="{{ route('orders.create', $service) }}" class="block w-full rounded-md bg-brand px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-orange-600">Pilih Paket</a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full rounded-md bg-brand px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-orange-600">Login untuk Pilih Layanan</a>
                        @endauth
                    </div>
                </div>
            </article>
        @empty
            <p>Layanan belum tersedia.</p>
        @endforelse
    </div>
</section>
@endsection
