@extends('layouts.app')

@section('title', 'contact')

@section('content')
    <div class="mx-auto max-w-xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">contact</h1>
        <p class="mt-1 text-sm text-slate-600">send a message to the admin</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div>
                <label class="text-sm font-medium">name</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">email</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">subject</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="text" name="subject" value="{{ old('subject') }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">message</label>
                <textarea class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                          rows="6" name="message" required>{{ old('message') }}</textarea>
            </div>

            <button class="w-full rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                send
            </button>

            <p class="mt-2 text-xs text-slate-500">
                note: with mailer=log, the email is written to <b>storage/logs/laravel.log</b>
            </p>
        </form>
    </div>
@endsection
