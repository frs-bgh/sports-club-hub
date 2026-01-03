<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'admin - sports club hub')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="bg-slate-900 text-white">
    <div class="mx-auto max-w-6xl px-4">
        <nav class="flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="font-semibold text-white hover:text-slate-200">
                sports club hub (admin)
            </a>

            <div class="flex items-center gap-6 text-sm">
                <a href="{{ route('home') }}" class="text-slate-100 hover:text-white">home</a>
                <a href="{{ route('admin.users.index') }}" class="text-slate-100 hover:text-white">admin users</a>

                @if (Route::has('admin.news.index'))
                    <a href="{{ route('admin.news.index') }}" class="text-slate-100 hover:text-white">admin news</a>
                @endif

                @if (Route::has('admin.faq-categories.index'))
                    <a href="{{ route('admin.faq-categories.index') }}" class="text-slate-100 hover:text-white">faq categories</a>
                @endif

                @if (Route::has('admin.faq-questions.index'))
                    <a href="{{ route('admin.faq-questions.index') }}" class="text-slate-100 hover:text-white">faq questions</a>
                @endif

                @if (Route::has('admin.contacts.index'))
                    <a href="{{ route('admin.contacts.index') }}" class="text-slate-100 hover:text-white">contact messages</a>
                @endif
            </div>

            <div class="flex items-center gap-3">
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
