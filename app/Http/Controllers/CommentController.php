<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Http\Requests\Controllers\StoreCommentRequest;
use App\Http\Requests\Controllers\UpdateCommentRequest;

class CommentController extends Controller
{
    public function create()
    {
        $comments = Comment::all();

        return view('comments.create');
    }
    public function store(StoreCommentRequest $request, Article $article)
    {
        $request->validated();

        $comment = new Comment();
        $comment->article_id = $article->id;
        $comment->user_id = Auth::id();
        $comment->text = $request->input('text');
        $comment->save();

        return redirect()->route('articles.show', $article->id);
    }

    public function edit(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('articles.show')->with('error', 'Вы не можете редактировать этот комментарий');
        }
        if (auth()->user()->isEditor() || $comment->user_id === auth()->id()) {
            return view('comments.edit', compact('comment'));
        }
       
        return redirect()->route('articles.index')->with('error', 'Пользователь не авторизован');
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if (auth()->user()->isEditor() || auth()->id() === $comment->user_id) {
            $request->validated();

            $comment->text = $request->input('text');
            $comment->save();
    
            return redirect()->route('articles.show', $comment->article_id);
        }
    
        return redirect()->route('articles.index')->with('error', 'Вы не можете редактировать этот комментарий');

        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('articles.show')->with('error', 'Вы не можете редактировать этот комментарий');
        }

       

        return redirect()->route('articles.show', $comment->article_id);
    }

    public function destroy(Comment $comment, $articleId)
    {
        if (auth()->id() === $comment->user_id) {
            $articleId = $comment->article_id;
            $comment->delete();
    
            return redirect()->route('articles.show', $articleId);
        }
    
        return redirect()->route('articles.show')->with('error', 'Вы не можете удалить этот комментарий');

        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('articles.show')->with('error', 'Вы не можете удалить этот комментарий');
        }

        return redirect()->route('articles.show', $articleId);
    }
        
    
}
