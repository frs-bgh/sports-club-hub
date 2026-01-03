@extends('layouts.app')

@section('title', 'members')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">members</h1>
                <p class="mt-1 text-sm text-slate-600">find users and open their public profile</p>

                @if(!$isAdminViewer)
                    <p class="mt-2 text-xs text-slate-500">
                        note: admin accounts are hidden for visitors
                    </p>
                @endif
            </div>

            <form method="GET" action="{{ route('profiles.index') }}" class="flex w-full gap-2 md:w-auto">
                <input
                    class="w-full md:w-80 rounded-lg border border-slate-300 px-3 py-2 text-sm outline-none focus:border-slate-900"
                    type="text"
                    name="q"
                    value="{{ $q }}"
                    placeholder="search by name, username or email"
                >
                <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                    search
                </button>
            </form>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($users as $u)
                <a href="{{ route('profiles.show', $u) }}"
                   class="group rounded-2xl border border-slate-200 p-4 hover:bg-slate-50">
                    <div class="flex items-center gap-3">
                        @if ($u->profile_photo_path)
                            <img
                                src="{{ asset('storage/' . $u->profile_photo_path) }}"
                                alt="profile photo"
                                class="h-12 w-12 rounded-full object-cover border border-slate-200"
                            >
                        @else
                            @php
                                $letter = strtoupper(substr(($u->username ?? $u->name ?? $u->email), 0, 1));
                            @endphp
                            <div class="h-12 w-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-semibold">
                                {{ $letter }}
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <div class="font-medium text-slate-900 truncate">
                                    {{ $u->username ?: $u->name }}
                                </div>

                                @if($u->is_admin)
                                    <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[11px] text-slate-700">
                                        admin
                                    </span>
                                @endif
                            </div>

                            <div class="text-sm text-slate-600 truncate">{{ $u->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 text-xs text-slate-500">
                        birthday: {{ optional($u->birthday)->format('Y-m-d') ?? '-' }}
                    </div>

                    <div class="mt-3 text-sm font-medium text-slate-900 group-hover:underline">
                        view profile →
                    </div>
                </a>
            @empty
                <div class="text-sm text-slate-600">
                    no users found
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection
