@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <h1 class="text-3xl font-light text-navy mb-2">Login</h1>
    <p class="text-sm text-gray-500 mb-8">Masuk ke akun Anda.</p>
    @if(session('success'))<div class="mb-4 bg-green-50 text-green-700 p-3 text-sm">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf
        <div><label class="block text-sm mb-1">Email</label><input name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full border px-3 py-2">@error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror</div>
        <div>
            <label class="block text-sm mb-1">Password</label>
            <div class="relative">
                <input name="password" type="password" required class="w-full border px-3 py-2 pr-10">
                <button type="button" data-password-toggle aria-label="Tampilkan password" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-brand">
                    <svg data-password-icon viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current stroke-2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                        <circle cx="12" cy="12" r="2.5"/>
                    </svg>
                </button>
            </div>
            @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <label class="flex items-center gap-2 text-sm"><input name="remember" type="checkbox" value="1"> Ingat saya</label>
        <button class="w-full bg-brand text-white py-3">Login</button>
    </form>
    <p class="text-sm mt-6">Belum punya akun? <a class="text-brand" href="{{ route('register') }}">Daftar sekarang</a></p>
</div>
@endsection
