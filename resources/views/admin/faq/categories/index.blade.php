@extends('layouts.admin')

@section('title', 'faq categories')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold">faq categories</h1>
                <p class="mt-1 text-sm text-slate-600">create, edit and delete categories</p>
            </div>

            <a href="{{ route('admin.faq-categories.create') }}"
               class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                + create category
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="text-left text-slate-600 border-b">
                    <th class="py-3 pr-4">id</th>
                    <th class="py-3 pr-4">name</th>
                    <th class="py-3 pr-4">actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $cat)
                    <tr class="border-b last:border-0">
                        <td class="py-3 pr-4">{{ $cat->id }}</td>
                        <td class="py-3 pr-4">{{ $cat->name }}</td>
                        <td class="py-3 pr-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.faq-categories.edit', $cat) }}"
                                   class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium hover:bg-slate-50">
                                    edit
                                </a>
                                <form method="POST" action="{{ route('admin.faq-categories.destroy', $cat) }}"
                                      onsubmit="return confirm('delete this category? (questions will be deleted too)');">
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
            <a class="text-sm text-slate-700 hover:underline" href="{{ route('admin.faq-questions.index') }}">manage questions →</a>
        </div>
    </div>
@endsection
