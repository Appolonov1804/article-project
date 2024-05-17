@extends('layouts.main')
@section('content')

    <div class="mt-4">
        <h4>Добавить комментарий:</h4>
        <form action="{{ route('comments.store', $article) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="text">Комментарий</label>
                <textarea class="form-control" id="text" name="text" placeholder="Введите комментарий"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить комментарий</button>
        </form>
    </div>
 @endsection