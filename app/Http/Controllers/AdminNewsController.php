<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = NewsItem::with(['author', 'tags'])
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('admin.news.index', [
            'news' => $news,
        ]);
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();

        return view('admin.news.create', [
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:20000'],
            'published_at' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'], // 2mb
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news-images', 'public');
        }

        $newsItem = NewsItem::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
            'image_path' => $imagePath,
            'author_id' => auth()->id(),
        ]);

        $newsItem->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'news item created');
    }

    public function edit(NewsItem $news)
    {
        $tags = Tag::orderBy('name')->get();

        return view('admin.news.edit', [
            'news' => $news->load('tags'),
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, NewsItem $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:20000'],
            'published_at' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'], // 2mb
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('news-images', 'public');
        }

        $news->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
            'image_path' => $validated['image_path'] ?? $news->image_path,
        ]);

        $news->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'news item updated');
    }

    public function destroy(NewsItem $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->tags()->detach();
        $news->delete();

        return back()->with('success', 'news item deleted');
    }
}
