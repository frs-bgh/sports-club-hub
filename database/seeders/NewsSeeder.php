<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // create a tiny placeholder image stored on server (public disk)
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="600"><rect width="100%" height="100%" fill="#0f172a"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#e2e8f0" font-size="48" font-family="Arial">news image</text></svg>';
        Storage::disk('public')->put('news/placeholder.svg', $svg);

        $admin = User::where('email', 'admin@ehb.be')->first();

        $item1 = NewsItem::updateOrCreate(
            ['title' => 'welcome to sports club hub'],
            [
                'content' => "this is the first news item.\nadmins can create, edit and delete news.\nvisitors can read the list and details.",
                'image_path' => 'news/placeholder.svg',
                'published_at' => now()->subDays(2),
                'author_id' => $admin?->id,
            ]
        );

        $item2 = NewsItem::updateOrCreate(
            ['title' => 'next training session'],
            [
                'content' => "training starts at 18:00.\nbring water and sport shoes.",
                'image_path' => 'news/placeholder.svg',
                'published_at' => now()->subDay(),
                'author_id' => $admin?->id,
            ]
        );

        $tags = Tag::whereIn('slug', ['club', 'training'])->get();
        $item1->tags()->syncWithoutDetaching($tags->pluck('id'));
        $item2->tags()->syncWithoutDetaching($tags->pluck('id'));
    }
}
