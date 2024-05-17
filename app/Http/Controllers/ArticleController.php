<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\Controllers\StoreArticleRequest;
use App\Http\Requests\Controllers\UpdateArticleRequest;


class ArticleController extends Controller
{
    public function create(Article $article) 
    {
        $articles = Article::all();

        return view('articles.create', compact('articles', 'article'));
    }

    public function store(StoreArticleRequest $request) 
    {
        $data = $request->validated();
        $user = Auth::user();

        $article = Article::create([
            'user_id' => $user->id, 
            'title' => $data['title'],
            'text' => $data['text']
        ]);

        return redirect()->route('articles.show', $article->id);
    }



    public function show(Article $article) 
    {
        $articles = Article::all();

        return view('articles.show', compact('articles', 'article'));
    }

    public function edit(Article $article) 
    {
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.show')->with('error', 'Вы не можете редактировать эту статью');
        }
        $articles = Article::all();

        return view('articles.edit', compact('articles', 'article'));
    }

    public function update(UpdateArticleRequest $request, Article $article, Comment $comment) 
    {
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Вы не можете редактировать эту статью');
        }
        $articles = Article::all();

        $data = $request->validated();
        $user = Auth::user();
        
            $article->update([
                'user_id' => $user->id,
                'title' => $data['title'],
                'text' => $data['text']
            ]);
        
            return redirect()->route('articles.show', $comment->article_id);
    }
    

    public function delete($articleId) 
    {
        $article = Article::find($articleId);
        $userId = $article->user_id;
        if ($article) {
            $article->delete();
            return redirect()->route('articles.show');
        } else {
            return redirect()->route('articles.show')->with('error', 'Статья не найдена');
        }
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.show')->with('error', 'Вы не можете удалить эту статью');
        }
    }

    public function destroy(Article $article) 
    {
        $article->delete();
        $userId = $article->user_id;
        return redirect()->route('articles.show');
    }


}
