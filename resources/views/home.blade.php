@extends('layouts.app')

@section('title', 'home')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">sports club hub</h1>
        <p class="mt-2 text-slate-600">
            simple app to manage accounts, profiles, and admin users
        </p>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <h2 class="font-medium">quick actions</h2>

                @auth
                    <p class="mt-2 text-sm text-slate-600">
                        you are logged in as <span class="font-medium text-slate-900">{{ auth()->user()->email }}</span>
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ route('dashboard') }}" class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                            go to dashboard
                        </a>

                        <a href="{{ route('profile.edit') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-white">
                            edit my profile
                        </a>

                        <a href="{{ route('profiles.show', auth()->user()) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-white">
                            my public profile
                        </a>

                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.users.index') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-white">
                                admin: manage users
                            </a>
                        @endif
                    </div>
                @else
                    <p class="mt-2 text-sm text-slate-600">
                        create an account or login to access your dashboard
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ route('login') }}" class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                            login
                        </a>
                        <a href="{{ route('register') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-white">
                            register
                        </a>
                    </div>
                @endauth
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-4">
                <h2 class="font-medium">what you can test</h2>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-600">
                    <li>register and login</li>
                    <li>edit profile (username, birthday, about me, photo)</li>
                    <li>public profile page</li>
                    <li>admin users list (admin only)</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
