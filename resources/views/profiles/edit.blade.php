@extends('layouts.app')

@section('title', 'edit profile')

@section('content')
    <div class="mx-auto max-w-2xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">edit my profile</h1>
        <p class="mt-1 text-sm text-slate-600">update your public profile info</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-medium">username</label>
                <input
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                    type="text"
                    name="username"
                    value="{{ old('username', auth()->user()->username) }}"
                    placeholder="e.g. faris_bgh"
                >
            </div>

            <div>
                <label class="text-sm font-medium">birthday</label>
                <input
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                    type="date"
                    name="birthday"
                    value="{{ old('birthday', auth()->user()->birthday) }}"
                >
            </div>

            <div>
                <label class="text-sm font-medium">about me</label>
                <textarea
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                    name="about_me"
                    rows="4"
                    placeholder="write a short text..."
                >{{ old('about_me', auth()->user()->about_me) }}</textarea>
            </div>

            <div>
                <label class="text-sm font-medium">profile photo</label>

                <div class="mt-2 flex items-center gap-3">
                    <input id="profile_photo" type="file" name="profile_photo" accept="image/*" class="hidden">
                    <label for="profile_photo"
                           class="cursor-pointer rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium hover:bg-slate-50">
                        choose file
                    </label>

                    <span class="text-sm text-slate-600" data-file-name>no file selected</span>
                </div>

                <p class="mt-2 text-xs text-slate-500">jpg/png/webp, max 2mb</p>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <button
                    type="submit"
                    class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800"
                >
                    save changes
                </button>

                <a href="{{ route('profiles.show', auth()->user()) }}"
                   class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">
                    view my profile
                </a>
            </div>
        </form>
    </div>
@endsection
