<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }
    
    public function create(): View
    {
        return view('articles.create');
    }
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);
    
        Article::create($request->only('title', 'body'));
        return redirect()->route('articles.index');
    }
    
    public function show(Article $article): View
    {
        return view('articles.show', compact('article'));
    }
    
    public function edit(Article $article): View
    {
        return view('articles.edit', compact('article'));
    }
    
    public function update(Request $request, Article $article): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required',
        ]);
    
        $article->update($request->only('title', 'body'));
        return redirect()->route('articles.index');
    }
    
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
