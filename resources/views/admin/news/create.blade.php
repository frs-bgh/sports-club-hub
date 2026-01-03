@extends('layouts.admin')

@section('title', 'create news')

@section('content')
    <div class="mx-auto max-w-2xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">create news</h1>
        <p class="mt-1 text-sm text-slate-600">add a new news item</p>

        @if ($errors->any())
            <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label class="text-sm font-medium">title</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                       type="text" name="title" value="{{ old('title') }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">published at</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                       type="datetime-local" name="published_at"
                       value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div>
                <label class="text-sm font-medium">content</label>
                <textarea class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-slate-900"
                          name="content" rows="6" required>{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="text-sm font-medium">image</label>
                <input class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                       type="file" name="image" accept="image/*">
                <p class="mt-1 text-xs text-slate-500">jpg/png/webp, max 2mb</p>
            </div>

            <div>
                <label class="text-sm font-medium">tags</label>
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                        <label class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1 text-sm">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                   class="rounded border-slate-300"
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <button type="submit"
                        class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                    create
                </button>

                <a href="{{ route('admin.news.index') }}"
                   class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">
                    cancel
                </a>
            </div>
        </form>
    </div>
@endsection
