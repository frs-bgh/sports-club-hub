<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsItem::orderByDesc('published_at')->paginate(10);

        return view('news.index', [
            'news' => $news,
        ]);
    }

    public function show(NewsItem $newsItem)
    {
        $newsItem->load('tags');

        return view('news.show', [
            'item' => $newsItem,
        ]);
    }
}
