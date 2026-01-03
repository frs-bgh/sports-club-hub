@extends('layouts.app')

@section('title', 'profile')

@section('content')
    <div class="mx-auto max-w-2xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-start gap-4">
            @if ($user->profile_photo_path)
                <img
                    src="{{ asset('storage/' . $user->profile_photo_path) }}"
                    alt="profile photo"
                    class="h-20 w-20 rounded-full object-cover border border-slate-200"
                >
            @else
                <div class="h-20 w-20 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500">
                    ?
                </div>
            @endif

            <div class="flex-1">
                <h1 class="text-2xl font-semibold">
                    {{ $user->username ? $user->username : $user->name }}
                </h1>
                <p class="mt-1 text-sm text-slate-600">{{ $user->email }}</p>
            </div>
        </div>

        <div class="mt-6 space-y-3 text-sm">
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="font-medium text-slate-900">birthday</p>
                <p class="text-slate-700">{{ $user->birthday ?? '-' }}</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="font-medium text-slate-900">about me</p>
                <p class="text-slate-700 whitespace-pre-line">{{ $user->about_me ?? '-' }}</p>
            </div>
        </div>

        @auth
            @if (auth()->id() === $user->id)
                <div class="mt-6">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                        edit my profile
                    </a>
                </div>
            @endif
        @endauth
    </div>
@endsection
