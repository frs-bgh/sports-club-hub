@extends('layouts.admin')

@section('title', 'create user')

@section('content')
    <div class="mx-auto max-w-xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">create user</h1>
        <p class="mt-1 text-sm text-slate-600">admin creates a new account</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div>
                <label class="text-sm font-medium">name</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                       type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">email</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                       type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">password</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                       type="password" name="password" required>
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_admin" value="1" class="rounded border-slate-300" {{ old('is_admin') ? 'checked' : '' }}>
                admin account
            </label>

            <div class="flex items-center gap-2 pt-2">
                <button type="submit"
                        class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                    create
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">
                    cancel
                </a>
            </div>
        </form>
    </div>
@endsection
