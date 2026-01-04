@extends('layouts.admin')

@section('title', 'contact messages')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">contact messages</h1>
        <p class="mt-1 text-sm text-slate-600">messages sent from the contact page</p>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="text-left text-slate-600 border-b">
                    <th class="py-3 pr-4">id</th>
                    <th class="py-3 pr-4">name</th>
                    <th class="py-3 pr-4">email</th>
                    <th class="py-3 pr-4">subject</th>
                    <th class="py-3 pr-4">actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $m)
                    <tr class="border-b last:border-0">
                        <td class="py-3 pr-4">{{ $m->id }}</td>
                        <td class="py-3 pr-4">{{ $m->name }}</td>
                        <td class="py-3 pr-4">{{ $m->email }}</td>
                        <td class="py-3 pr-4">{{ $m->subject }}</td>
                        <td class="py-3 pr-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.contacts.show', $m) }}"
                                   class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium hover:bg-slate-50">
                                    view
                                </a>

                                <form method="POST" action="{{ route('admin.contacts.destroy', $m) }}"
                                      onsubmit="return confirm('delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-red-300 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
