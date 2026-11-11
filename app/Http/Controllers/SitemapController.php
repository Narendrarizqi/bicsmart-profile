<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $urls = collect(['home', 'tentang', 'edukasi', 'dokumentasi', 'berita.index', 'peta-sebaran', 'kontak'])
            ->map(fn ($r) => ['loc' => route($r), 'lastmod' => null]);

        Article::published()->get(['slug', 'updated_at'])->each(fn ($a) => $urls->push(['loc' => route('berita.show', $a), 'lastmod' => $a->updated_at]));
        Activity::published()->get(['slug', 'updated_at'])->each(fn ($a) => $urls->push(['loc' => route('dokumentasi.show', $a), 'lastmod' => $a->updated_at]));

        return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
    }
}
