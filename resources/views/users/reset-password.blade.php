@extends('layouts.app')

@section('title', 'reset password')

@section('content')
    <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">reset password</h1>
        <p class="mt-1 text-sm text-slate-600">choose a new password</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="text-sm font-medium">email</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="email" name="email" value="{{ old('email', $email) }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">new password</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="password" name="password" required>
            </div>

            <div>
                <label class="text-sm font-medium">confirm password</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="password" name="password_confirmation" required>
            </div>

            <button class="w-full rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                reset password
            </button>
        </form>
    </div>
@endsection
