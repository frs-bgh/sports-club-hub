@extends('layouts.admin')

@section('title', 'edit faq category')

@section('content')
    <div class="mx-auto max-w-xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">edit category</h1>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('admin.faq-categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-medium">name</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="text" name="name" value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">save</button>
                <a href="{{ route('admin.faq-categories.index') }}"
                   class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">cancel</a>
            </div>
        </form>
    </div>
@endsection
