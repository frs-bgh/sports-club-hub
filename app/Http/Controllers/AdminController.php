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
        $news = NewsItem::orderByDesc('id')->paginate(20);

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
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'image' => ['required', 'image', 'max:2048'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        $path = $request->file('image')->store('news', 'public');

        $item = NewsItem::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'] ?? now(),
            'image_path' => $path,
            'author_id' => $request->user()->id,
        ]);

        $item->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.news.index')->with('success', 'news created');
    }

    public function edit(NewsItem $news)
    {
        $tags = Tag::orderBy('name')->get();

        return view('admin.news.edit', [
            'item' => $news,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, NewsItem $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $news->image_path = $request->file('image')->store('news', 'public');
        }

        $news->title = $validated['title'];
        $news->content = $validated['content'];
        $news->published_at = $validated['published_at'] ?? $news->published_at;
        $news->save();

        $news->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.news.index')->with('success', 'news updated');
    }

    public function destroy(NewsItem $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->tags()->detach();
        $news->delete();

        return back()->with('success', 'news deleted');
    }
}
