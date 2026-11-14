@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <h1 class="text-3xl font-light text-navy mb-2">Register</h1>
    <p class="text-sm text-gray-500 mb-8">Buat akun baru untuk Anda.</p>
    <form method="POST" action="{{ route('register.store') }}" class="space-y-5" data-register-form>
        @csrf
        <div><label for="name" class="block text-sm mb-1">Nama</label><input id="name" name="name" value="{{ old('name') }}" required class="w-full border px-3 py-2">@error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror</div>
        <div><label for="email" class="block text-sm mb-1">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full border px-3 py-2">@error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror</div>
        <div>
            <label for="password" class="block text-sm mb-1">Password</label>
            <div class="relative">
                <input id="password" name="password" type="password" required class="w-full border px-3 py-2 pr-10">
                <button type="button" data-password-toggle aria-label="Tampilkan password" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-brand">
                    <svg data-password-icon viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current stroke-2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                        <circle cx="12" cy="12" r="2.5"/>
                    </svg>
                </button>
            </div>
            @error('password')<p class="text-red-600 text-xs mt-1">{{ $messag }}</p>@enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm mb-1">Konfirmasi Password</label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full border px-3 py-2 pr-10">
                <button type="button" data-password-toggle aria-label="Tampilkan password" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-brand">
                    <svg data-password-icon viewBox="0 0 24 24" class="h-5 w-5 fill-none stroke-current stroke-2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                        <circle cx="12" cy="12" r="2.5"/>
                    </svg>
                </button>
            </div>
        </div>
        <button class="w-full bg-brand text-white py-3">Daftar</button>
    </form>
    <p class="text-sm mt-6">Sudah punya akun? <a class="text-brand" href="{{ route('login') }}">Login</a></p>
</div>

<script>
    document.querySelector('[data-register-form]').addEventListener('keydown', function (event) {
        if (event.key !== 'Enter' || event.target.tagName === 'TEXTAREA') {
            return;
        }

        event.preventDefault();

        const fields = Array.from(this.querySelectorAll('input:not([type="hidden"]), select, textarea'));
        const currentIndex = fields.indexOf(event.target);
        const nextField = fields[currentIndex + 1];

        if (nextField) {
            nextField.focus();
        }
    });
</script>
@endsection
