@extends('layouts.admin')

@section('title', 'admin users')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold">admin users</h1>
                <p class="mt-1 text-sm text-slate-600">create, toggle admin, delete users</p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                + create user
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="text-left text-slate-600 border-b">
                    <th class="py-3 pr-4">id</th>
                    <th class="py-3 pr-4">name</th>
                    <th class="py-3 pr-4">email</th>
                    <th class="py-3 pr-4">admin?</th>
                    <th class="py-3 pr-4">actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="border-b last:border-0">
                        <td class="py-3 pr-4">{{ $user->id }}</td>
                        <td class="py-3 pr-4">{{ $user->name }}</td>
                        <td class="py-3 pr-4">{{ $user->email }}</td>
                        <td class="py-3 pr-4">
                            <span class="inline-flex rounded-full px-2 py-1 text-xs font-medium
                                {{ $user->is_admin ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-700' }}">
                                {{ $user->is_admin ? 'yes' : 'no' }}
                            </span>
                        </td>
                        <td class="py-3 pr-4">
                            <div class="flex flex-wrap gap-2">

                                @if ($user->email !== 'admin@ehb.be')
                                    <form method="POST" action="{{ route('admin.users.toggleAdmin', $user) }}">
                                        @csrf
                                        <button type="submit"
                                                class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium hover:bg-slate-50">
                                            {{ $user->is_admin ? 'remove admin' : 'make admin' }}
                                        </button>
                                    </form>
                                @endif

                                @if ($user->email !== 'admin@ehb.be')
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-lg border border-red-300 bg-white px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">
                                            delete
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
