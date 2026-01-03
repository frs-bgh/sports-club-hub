@extends('layouts.admin')

@section('title', 'admin news')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold">admin news</h1>
                <p class="mt-1 text-sm text-slate-600">create, edit and delete news items</p>
            </div>

            <a href="{{ route('admin.news.create') }}"
               class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                + create news
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                <tr class="border-b text-left text-slate-600">
                    <th class="py-3 pr-4">title</th>
                    <th class="py-3 pr-4">published</th>
                    <th class="py-3 pr-4">author</th>
                    <th class="py-3 pr-4">actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($news as $item)
                    <tr class="border-b last:border-0">
                        <td class="py-3 pr-4">
                            <div class="font-medium text-slate-900">{{ $item->title }}</div>
                            <div class="text-xs text-slate-600">
                                {{ $item->tags->pluck('name')->implode(', ') }}
                            </div>
                        </td>
                        <td class="py-3 pr-4">
                            {{ optional($item->published_at)->format('Y-m-d H:i') }}
                        </td>
                        <td class="py-3 pr-4">
                            {{ $item->author?->email ?? '-' }}
                        </td>
                        <td class="py-3 pr-4">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('admin.news.edit', $item) }}"
                                   class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium hover:bg-slate-50">
                                    edit
                                </a>

                                <form method="POST" action="{{ route('admin.news.destroy', $item) }}"
                                      onsubmit="return confirm('delete this news item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="rounded-lg border border-red-300 bg-white px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-slate-600">no news yet</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $news->links() }}
        </div>
    </div>
@endsection
