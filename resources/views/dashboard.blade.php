@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">dashboard</h1>
        <p class="mt-2 text-slate-600">hello <span class="font-medium text-slate-900">{{ auth()->user()->email }}</span></p>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <a href="{{ route('profile.edit') }}"
               class="rounded-xl border border-slate-200 p-4 hover:bg-slate-50">
                <h2 class="font-medium">edit my profile</h2>
                <p class="mt-1 text-sm text-slate-600">update your username, birthday, about me and photo</p>
            </a>

            <a href="{{ route('profiles.show', auth()->user()) }}"
               class="rounded-xl border border-slate-200 p-4 hover:bg-slate-50">
                <h2 class="font-medium">my public profile</h2>
                <p class="mt-1 text-sm text-slate-600">see what others can view</p>
            </a>

            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.users.index') }}"
                   class="rounded-xl border border-slate-200 p-4 hover:bg-slate-50 md:col-span-2">
                    <h2 class="font-medium">admin users</h2>
                    <p class="mt-1 text-sm text-slate-600">create, toggle admin, delete users</p>
                </a>
            @endif
        </div>
    </div>
@endsection
