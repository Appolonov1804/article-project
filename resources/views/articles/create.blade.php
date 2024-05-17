@extends('layouts.main')
@section('content')
<form action="{{ route('articles.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="inputTitle">Заголовок</label>
        <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Введите заголовок">
    </div>
    <div class="form-group">
        <label for="inputText">Статья</label>
        <textarea class="form-control" id="inputText" name="text" placeholder="Введите текст"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
@endsection