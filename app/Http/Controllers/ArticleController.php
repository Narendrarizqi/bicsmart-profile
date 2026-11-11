<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->string('kategori')->toString();
        $q = trim($request->string('q')->toString());

        $articles = Article::published()
            ->when(array_key_exists($category, Article::CATEGORIES), fn ($x) => $x->where('category', $category))
            ->when($q !== '', fn ($x) => $x->where(fn ($w) => $w->where('title', 'like', "%{$q}%")->orWhere('summary', 'like', "%{$q}%")))
            ->paginate(9)->withQueryString();

        return view('articles.index', compact('articles', 'category', 'q'));
    }

    public function show(Article $article)
    {
        abort_unless($article->status === 'published' && $article->published_at?->isPast(), 404);

        return view('articles.show', [
            'article' => $article->load('author'),
            'related' => Article::published()->whereKeyNot($article->id)->take(3)->get(),
        ]);
    }
}
