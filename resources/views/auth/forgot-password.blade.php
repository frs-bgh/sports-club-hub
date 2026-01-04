@extends('layouts.app')

@section('title', 'forgot password')

@section('content')
    <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">forgot password</h1>
        <p class="mt-1 text-sm text-slate-600">we will send you a reset link</p>

        <form class="mt-6 space-y-4" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <label class="text-sm font-medium">email</label>
                <input
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800"
            >
                send reset link
            </button>

            <p class="text-center text-sm text-slate-600">
                <a class="font-medium text-slate-900 hover:underline" href="{{ route('login') }}">back to login</a>
            </p>
        </form>
    </div>
@endsection
