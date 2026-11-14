@extends('layouts.app')
@section('title', 'Profile Perusahaan - '.$setting->site_name)

@section('content')
<section class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-12">
    <div class="relative self-start">
        <div class="absolute -left-3 -bottom-3 w-full h-full bg-brand"></div>
        @if($setting->about_image)
            <img src="{{ str_starts_with($setting->about_image, 'http') ? $setting->about_image : asset('storage/'.$setting->about_image) }}" alt="Tentang {{ $setting->site_name }}" class="relative h-96 w-full object-cover">
        @else
            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1200&q=85" alt="Tentang {{ $setting->site_name }}" class="relative h-96 w-full object-cover">
        @endif
    </div>
    <div>
        <h1 class="text-3xl font-light mb-6">{{ $setting->site_name }}</h1>
        <div class="prose max-w-none text-sm leading-relaxed [&_ul]:list-disc [&_ul]:pl-6 [&_p]:mb-4">
            {!! $setting->site_description !!}
        </div>
    </div>
</section>
@endsection
