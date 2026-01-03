@extends('layouts.app')

@section('title', 'news')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold">news</h1>
                <p class="mt-1 text-sm text-slate-600">latest updates</p>
            </div>

            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.news.index') }}"
                       class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50">
                        admin: manage news
                    </a>
                @endif
            @endauth
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            @foreach($news as $item)
                <a href="{{ route('news.show', $item) }}"
                   class="rounded-xl border border-slate-200 p-4 hover:bg-slate-50">
                    <div class="text-sm text-slate-500">
                        {{ $item->published_at ? $item->published_at->format('Y-m-d H:i') : '-' }}
                    </div>
                    <div class="mt-1 font-medium text-slate-900">{{ $item->title }}</div>
                    <div class="mt-2 text-sm text-slate-600 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($item->content, 140) }}
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $news->links() }}
        </div>
    </div>
@endsection
