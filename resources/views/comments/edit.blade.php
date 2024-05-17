@extends('layouts.main')
@section('content')
    <div class="mt-4">
        <h4>Редактировать комментарий:</h4>
        <form action="{{ route('comments.update', $comment) }}" method="post">
            @method('patch')
            <div class="form-group">
                <label for="text">Комментарий</label>
                <textarea class="form-control" id="text" name="text" placeholder="Введите комментарий">{{ $comment->text }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection