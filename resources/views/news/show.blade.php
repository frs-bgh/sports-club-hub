@extends('layouts.app')

@section('title', $item->title)

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <a href="{{ route('news.index') }}" class="text-sm text-slate-600 hover:underline">← back to news</a>

        <h1 class="mt-3 text-2xl font-semibold">{{ $item->title }}</h1>
        <p class="mt-1 text-sm text-slate-600">
            published: {{ $item->published_at ? $item->published_at->format('Y-m-d H:i') : '-' }}
        </p>

        @if($item->image_path)
            <img class="mt-5 w-full rounded-xl border border-slate-200 object-cover"
                 src="{{ asset('storage/' . $item->image_path) }}" alt="news image">
        @endif

        <div class="mt-5 text-sm text-slate-800 whitespace-pre-line">
            {{ $item->content }}
        </div>

        @if($item->tags->count())
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach($item->tags as $tag)
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">{{ $tag->name }}</span>
                @endforeach
            </div>
        @endif
    </div>
@endsection
