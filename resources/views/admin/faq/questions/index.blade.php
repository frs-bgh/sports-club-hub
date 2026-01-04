@extends('layouts.admin')

@section('title', 'faq questions')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold">faq questions</h1>
                <p class="mt-1 text-sm text-slate-600">create, edit and delete questions</p>
            </div>

            <a href="{{ route('admin.faq-questions.create') }}"
               class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                + create question
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="text-left text-slate-600 border-b">
                    <th class="py-3 pr-4">id</th>
                    <th class="py-3 pr-4">category</th>
                    <th class="py-3 pr-4">question</th>
                    <th class="py-3 pr-4">actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $q)
                    <tr class="border-b last:border-0">
                        <td class="py-3 pr-4">{{ $q->id }}</td>
                        <td class="py-3 pr-4">{{ $q->category?->name }}</td>
                        <td class="py-3 pr-4">{{ $q->question }}</td>
                        <td class="py-3 pr-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.faq-questions.edit', $q) }}"
                                   class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium hover:bg-slate-50">
                                    edit
                                </a>
                                <form method="POST" action="{{ route('admin.faq-questions.destroy', $q) }}"
                                      onsubmit="return confirm('delete this question?');">
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
            <a class="text-sm text-slate-700 hover:underline" href="{{ route('admin.faq-categories.index') }}">manage categories →</a>
        </div>
    </div>
@endsection
