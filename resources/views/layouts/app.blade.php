<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $setting->site_name ?? 'PT Solusi Net Nusantara')</title>
    <meta name="description" content="@yield('meta_description', 'Layanan internet broadband, instalasi jaringan, dan maintenance jaringan')">
    @hasSection('meta_keyword')<meta name="keywords" content="@yield('meta_keyword')">@endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            fontFamily: { sans: ['Poppins', 'sans-serif'] },
            colors: { brand: '#ff3d14', navy: '#0f1b5c' }
        } } }
    </script>
</head>
<body class="min-h-screen flex flex-col font-sans text-gray-700 bg-[#f5f3ef]">
@php
    $setting = \App\Models\SiteSetting::current();
    $wa = 'https://wa.me/' . preg_replace('/\D/', '', $setting->phone ?? '');
@endphp

<header class="border-b bg-white sticky top-0 z-30">
    <div class="max-w-6xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-3">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            @if($setting->logo ?? null)
                <img src="{{ str_starts_with($setting->logo, 'http') ? $setting->logo : asset('storage/'.$setting->logo) }}" class="h-10" alt="logo">
            @endif
            <span class="font-semibold text-navy">{{ $setting->site_name ?? 'PT Solusi Net Nusantara' }}</span>
        </a>
        <div class="hidden md:flex gap-6 text-sm">
            <a href="mailto:{{ $setting->email }}"><span class="text-brand">✉</span> {{ $setting->email }}</a>
            <a href="{{ $wa }}" target="_blank"><span class="text-brand">☎</span> {{ $setting->phone }}</a>
        </div>
    </div>
    <nav class="max-w-6xl mx-auto px-4 flex flex-wrap gap-x-8 gap-y-1 text-sm pb-3">
        <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
        <a href="{{ route('profile') }}" class="hover:text-brand">Profile Perusahaan</a>
        <a href="{{ route('services') }}" class="hover:text-brand">Layanan</a>
        <a href="{{ route('gallery') }}" class="hover:text-brand">Gallery</a>
        <a href="{{ route('contact') }}" class="hover:text-brand">Kontak Kami</a>
        <span class="ml-auto flex items-center gap-3">
            @auth
                <a href="{{ route('user.profile') }}" class="text-navy hover:text-brand" aria-label="Profil Saya" title="Profil Saya">
                    <svg aria-hidden="true" viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current stroke-2">
                        <circle cx="12" cy="8" r="3.5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20c.8-3.2 3.4-5 7.5-5s6.7 1.8 7.5 5"/>
                    </svg>
                </a>
                <span class="text-navy">Halo, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="text-brand hover:underline">Logout</button></form>
            @else
                <a href="{{ route('login') }}" class="text-brand hover:underline">Login</a>
                <a href="{{ route('register') }}" class="bg-brand text-white px-3 py-1">Register</a>
            @endauth
        </span>
    </nav>
</header>

<main class="flex-1">@yield('content')</main>

<script>
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('input');
            const icon = button.querySelector('[data-password-icon]');
            const isVisible = input.type === 'text';

            input.type = isVisible ? 'password' : 'text';
            button.setAttribute('aria-label', isVisible ? 'Tampilkan password' : 'Sembunyikan password');
            icon.innerHTML = isVisible
                ? '<path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.6 6.2A10.7 10.7 0 0 1 12 6c6 0 9.5 6 9.5 6a17.8 17.8 0 0 1-3.1 3.8M6.1 6.8C3.8 8.3 2.5 12 2.5 12s3.5 6 9.5 6c1.7 0 3.2-.4 4.5-1.1"/>';
        });
    });
</script>

<footer class="bg-slate-50 mt-16 shrink-0">
    <div class="max-w-6xl mx-auto px-4 py-12 grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
        <div>
            <div class="flex items-center gap-2 mb-4">
                @if($setting->logo ?? null)<img src="{{ str_starts_with($setting->logo, 'http') ? $setting->logo : asset('storage/'.$setting->logo) }}" class="h-10" alt="logo">@endif
                <span class="font-semibold text-navy">{{ $setting->site_name }}</span>
            </div>
            <div class="flex gap-2 text-white">
                @php
                    $socialIcons = [
                        'facebook' => '<svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M13.5 21v-8h2.75l.41-3h-3.16V8.08c0-.87.24-1.46 1.5-1.46h1.84V3.94c-.32-.04-1.42-.14-2.7-.14-2.67 0-4.5 1.63-4.5 4.63V10H6.75v3h2.89v8h3.86Z"/></svg>',
                        'youtube' => '<svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M23.5 6.2a3 3 0 0 0-2.12-2.12C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.38.58A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.12 2.12C4.5 20.5 12 20.5 12 20.5s7.5 0 9.38-.58a3 3 0 0 0 2.12-2.12A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.6 15.8V8.2l6.4 3.8-6.4 3.8Z"/></svg>',
                        'instagram' => '<svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-none stroke-current stroke-[1.8]"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="4.8"/><circle cx="12" cy="12" r="4.1"/><circle cx="17.5" cy="6.6" r="1" class="fill-current stroke-none"/></svg>',
                        'tiktok' => '<svg aria-hidden="true" viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15.5 3h3.1c.4 2.2 1.7 3.6 3.4 4.2v3.1c-1.3-.1-2.5-.5-3.6-1.2v6.1c0 4-2.8 6.8-6.8 6.8-3.6 0-6.1-2.5-6.1-5.8 0-3.5 2.8-6.1 6.7-6.1.4 0 .8 0 1.2.1v3.2c-.4-.1-.8-.2-1.2-.2-1.7 0-3.2 1-3.2 2.8 0 1.5 1.1 2.8 2.7 2.8 1.9 0 2.4-1.5 2.4-3.2V3Z"/></svg>',
                    ];
                @endphp
                @foreach($socialIcons as $network => $icon)
                    @if($setting->$network ?? null)
                        <a href="{{ $setting->$network }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($network) }}" class="w-8 h-8 rounded-full bg-navy flex items-center justify-center hover:bg-brand transition-colors">{!! $icon !!}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <h4 class="font-semibold text-navy mb-2">Alamat</h4>
            <p class="whitespace-pre-line">{{ $setting->address }}</p>
            @if($setting->maps_url ?? null)
                <a href="{{ $setting->maps_url }}" target="_blank" class="inline-block mt-4 bg-brand text-white px-5 py-2">Klik Disini</a>
            @endif
        </div>
        <div>
            <h4 class="font-semibold text-navy mb-2">Konsultasi Layanan</h4>
            <B class="collor-blue">Nomer Telepon</B>
            <p>{{ $setting->phone }}</p>
            <b class="color-blue">Email</b>
            <p>{{ $setting->email }}</p>
        </div>
        <div>
            <h4 class="font-semibold text-navy mb-2">Lokasi Kami</h4>
            <div id="footer-map" class="w-full h-48 border border-gray-200 bg-slate-100 cursor-grab" style="z-index:0" tabindex="0" role="application" aria-label="Peta lokasi {{ $setting->site_name }}"></div>
        </div>
    </div>
    <div class="border-t text-center text-xs py-4">Copyright © {{ date('Y') }} All rights reserved</div>
</footer>
<script>
    (function () {
        var coords = @json($setting->mapCoordinates());
        var center = coords ? [coords.lat, coords.lng] : [-2.5, 118];
        var zoom = coords ? 16 : 5;

        ['contact-map', 'footer-map'].forEach(function (mapId) {
            var element = document.getElementById(mapId);

            if (!element) {
                return;
            }

            var map = L.map(element, {
                dragging: true,
                touchZoom: true,
                doubleClickZoom: true,
                scrollWheelZoom: false,
                zoomControl: true,
                keyboard: true
            }).setView(center, zoom);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>'
            }).addTo(map);

            if (coords) {
                var marker = L.marker(center).addTo(map);
                var box = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = @json($setting->site_name);
                box.appendChild(strong);

                if (@json($setting->address)) {
                    var paragraph = document.createElement('div');
                    paragraph.style.whiteSpace = 'pre-line';
                    paragraph.textContent = @json($setting->address);
                    box.appendChild(paragraph);
                }

                marker.bindPopup(box);
            }

            map.on('focus', function () {
                map.scrollWheelZoom.enable();
            });
            map.on('blur', function () {
                map.scrollWheelZoom.disable();
            });
        });
    })();
</script>
</body>
</html>
