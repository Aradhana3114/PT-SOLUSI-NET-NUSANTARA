@extends('layouts.app')
@section('title', $object->name.' - '.$setting->site_name)

@section('content')
<section class="bg-gradient-to-r from-blue-700 to-indigo-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-20 text-center">
        <h1 class="text-4xl font-light uppercase">{{ $object->name }}</h1>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12 grid md:grid-cols-4 gap-10">
    <aside>
        <h3 class="font-semibold text-navy mb-4">{{ $module->name }}</h3>
        <ul class="text-sm divide-y">
            @foreach($siblings as $s)
                <li>
                    <a href="{{ route('module.object', [$module->slug, $s->slug]) }}"
                       class="block py-3 {{ $s->id === $object->id ? 'text-brand' : 'hover:text-brand' }}">{{ $s->name }}</a>
                </li>
            @endforeach
        </ul>
    </aside>
    <div class="md:col-span-3">
        <h2 class="text-2xl font-light mb-4 uppercase">{{ $object->detail_header ?: $object->name }}</h2>
        @if($object->image)
            <img src="{{ asset('storage/'.$object->image) }}" alt="{{ $object->name }}" class="max-w-md w-full mb-6">
        @endif
        <div class="text-sm leading-relaxed [&_p]:mb-4 [&_strong]:text-brand [&_h3]:text-brand [&_h3]:font-medium [&_h3]:mt-4 [&_ul]:list-disc [&_ul]:pl-6">
            {!! $object->detail_description !!}
        </div>
    </div>
</section>
@endsection
