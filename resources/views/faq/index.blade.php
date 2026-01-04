@extends('layouts.app')

@section('title', 'faq')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold">faq</h1>
                <p class="mt-1 text-sm text-slate-600">questions and answers</p>
            </div>

            @auth
                @if(auth()->user()->is_admin)
                    <div class="flex gap-2">
                        <a class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50"
                           href="{{ route('admin.faq-categories.index') }}">admin categories</a>
                        <a class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50"
                           href="{{ route('admin.faq-questions.index') }}">admin questions</a>
                    </div>
                @endif
            @endauth
        </div>

        <div class="mt-6 space-y-6">
            @foreach($categories as $cat)
                <div class="rounded-xl border border-slate-200 p-4">
                    <h2 class="font-medium text-slate-900">{{ $cat->name }}</h2>

                    <div class="mt-3 space-y-3">
                        @forelse($cat->questions as $q)
                            <div class="rounded-lg bg-slate-50 p-3">
                                <p class="text-sm font-medium text-slate-900">{{ $q->question }}</p>
                                <p class="mt-1 text-sm text-slate-700 whitespace-pre-line">{{ $q->answer }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-600">no questions yet</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
