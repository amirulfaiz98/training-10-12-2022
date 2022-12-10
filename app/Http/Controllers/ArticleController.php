<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if($request->get('keyword') != null) {
            $articles = Article::where('title', 'like', '%'.$request->get('keyword').'%')->paginate(5);
        } else {
            $articles = Article::paginate(5);
        }

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        # method 1
        // $article = new Article();
        // $article->title = $request->title;
        // $article->body = $request->body;
        // $article->save();

        # method 2
        // Article::create($request->only('title', 'body'));

        # method 3 with relationship
        $article = auth()->user()->articles()->create($request->only('title', 'body'));

        if($request->hasFile('attachment')) {
            $filename = $article->id.'-'.date('Y-m-d').'.'.$request->attachment->getClientOriginalExtension();
            Storage::disk('public')->put($filename, File::get($request->attachment));
            $article->attachment = $filename;
            $article->save();
        }


        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->only('title', 'body'));

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function delete(Article $article)
    {
        if($article->attachment) {
            Storage::disk('public')->delete($article->attachment);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('warning', 'Article deleted successfully.');
    }
}
