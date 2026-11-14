@extends('layouts.app')
@section('title', 'Gallery Layanan Internet - '.$setting->site_name)

@section('content')
<section class="bg-gradient-to-r from-slate-700 to-blue-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-20 text-center"><h1 class="text-4xl font-light">Gallery Layanan Internet</h1><p class="mt-3 text-sm text-slate-200">Dokumentasi website company profile, instalasi, dan maintenance jaringan.</p></div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse($galleries as $gallery)
            <figure class="overflow-hidden bg-[#dedede] shadow-sm">
                <img src="{{ str_starts_with($gallery->image, 'http') ? $gallery->image : asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="h-48 w-full object-cover">
                <figcaption class="p-3">
                    <h2 class="text-sm font-medium text-navy">{{ $gallery->title }}</h2>
                    @if($gallery->description)
                        <p class="mt-1 text-sm text-gray-600">{{ $gallery->description }}</p>
                    @endif
                </figcaption>
            </figure>
        @empty
            <p>Belum ada gallery.</p>
        @endforelse
    </div>
</section>
@endsection
