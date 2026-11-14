@extends('layouts.app')
@section('title', 'Kontak Kami - '.$setting->site_name)

@section('content')
<section class="bg-gradient-to-r from-blue-700 to-indigo-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-20 text-center"><h1 class="text-4xl font-light">Kontak Kami</h1></div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid md:grid-cols-2 gap-10 items-start">
        <div class="text-sm space-y-7 md:pt-6">
            <div>
                <h4 class="font-semibold text-navy mb-2">Alamat</h4>
                <p class="whitespace-pre-line">{{ $setting->address }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-navy mb-2">Email</h4>
                <p>{{ $setting->email }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-navy mb-2">Telepon / WhatsApp</h4>
                <p>{{ $setting->phone }}</p>
            </div>
            @if($setting->maps_url)
                <a href="{{ $setting->maps_url }}" target="_blank" rel="noopener" class="inline-block bg-brand text-white px-5 py-2">Lihat di Google Maps</a>
            @endif
        </div>

        <div>
            <div id="contact-map" class="w-full h-64 md:h-80 border border-gray-200 bg-slate-100 cursor-grab" style="z-index:0" tabindex="0" role="application" aria-label="Peta lokasi {{ $setting->site_name }}"></div>
            <p class="text-xs text-gray-500 mt-2">Geser peta dengan menahan klik kiri (atau sentuh dan geser di ponsel). Gunakan tombol +/- atau klik dua kali untuk memperbesar.</p>
        </div>
    </div>
</section>

@endsection
