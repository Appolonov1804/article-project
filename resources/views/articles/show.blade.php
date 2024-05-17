@extends('layouts.main')
@section('content')
    <div>
        <a href="{{ route('articles.edit', $article->id) }}">Редактировать</a>
    </div>
    <div>
        <form action="{{ route('articles.delete', $article->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Удалить" class="btn btn-danger">
        </form>
    </div>
    <div>
        <div>{{ $article->user_id }}. {{ $article->title }}. {{ $article->text }}</div>
    </div>

    <div class="mt-4">
        <h4>Добавить комментарий:</h4>
        <form action="{{ route('comments.create', $article) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="body">Комментарий</label>
                <textarea class="form-control" id="body" name="body" placeholder="Введите комментарий"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить комментарий</button>
        </form>
    </div>

    <div class="mt-4">
    <h4>Комментарии:</h4>
    @if ($article->comments->count() > 0)
        <ul>
            @foreach ($article->comments as $comment)
                <li>
                    {{ $comment->body }}
                    @if(auth()->user()->isEditor() || $comment->user_id === auth()->id())
                        <div>
                            <a href="{{ route('comments.edit', $comment->id) }}">Редактировать</a>
                        </div>
                        <div>
                            <form action="{{ route('comments.delete', $comment->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Удалить">
                            </form>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>Комментариев пока нет.</p>
    @endif
    </div>
@endsection