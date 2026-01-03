<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'sports club hub')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="bg-slate-900 text-white">
    <div class="mx-auto max-w-6xl px-4">
        <nav class="flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="font-semibold text-white hover:text-slate-200">
                sports club hub
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ route('home') }}" class="text-slate-100 hover:text-white">home</a>

                @if (Route::has('news.index'))
                    <a href="{{ route('news.index') }}" class="text-slate-100 hover:text-white">news</a>
                @endif

                @if (Route::has('faq.index'))
                    <a href="{{ route('faq.index') }}" class="text-slate-100 hover:text-white">faq</a>
                @endif

                @if (Route::has('contact.form'))
                    <a href="{{ route('contact.form') }}" class="text-slate-100 hover:text-white">contact</a>
                @endif

                @auth
                    <a href="{{ route('dashboard') }}" class="text-slate-100 hover:text-white">dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="text-slate-100 hover:text-white">edit profile</a>
                    <a href="{{ route('profiles.show', auth()->user()) }}" class="text-slate-100 hover:text-white">my public profile</a>

                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.users.index') }}" class="text-slate-100 hover:text-white">admin users</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('profiles.show', auth()->user()) }}"
                       class="hidden sm:inline-flex items-center gap-2 rounded-full bg-slate-800 px-3 py-1 text-sm text-slate-100 hover:bg-slate-700">

                        @if (auth()->user()->profile_photo_path)
                            <img
                                src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                alt="profile"
                                class="h-7 w-7 rounded-full object-cover border border-white/10"
                            >
                        @else
                            <div class="h-7 w-7 rounded-full bg-slate-700 border border-white/10 flex items-center justify-center text-xs font-semibold text-white">
                                {{ strtoupper(substr(auth()->user()->email, 0, 1)) }}
                            </div>
                        @endif

                        <span>{{ auth()->user()->email }}</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="rounded-lg bg-white px-3 py-1.5 text-sm font-medium text-slate-900 hover:bg-slate-100">
                            logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-white px-3 py-1.5 text-sm font-medium text-slate-900 hover:bg-slate-100">
                        login
                    </a>
                    <a href="{{ route('register') }}"
                       class="rounded-lg border border-white/30 px-3 py-1.5 text-sm font-medium text-white hover:bg-white/10">
                        register
                    </a>
                @endauth
            </div>
        </nav>
    </div>
</header>

<main class="mx-auto max-w-6xl px-4 py-8">
    <x-flash />

    @yield('content')
</main>
</body>
</html>
