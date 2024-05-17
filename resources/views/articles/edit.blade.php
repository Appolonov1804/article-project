@extends('layouts.main')
@section('content')

<form action="{{ route('articles.update', $article->id) }}" method="post"> 
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@method('patch')

  <div class="form-group">
    <label for="inputTitle">Заголовок</label>
    <input type="text" class="form-control" id="inputTitle" placeholder="Введите заголовок" name="title" value=" {{ $article->title }}">
  </div>

  <div class="form-group">
        <label for="inputText">Статья</label>
        <textarea class="form-control" id="inputText" placeholder="Введите текст" name="text" value=" {{ $article->text }}"></textarea>
    </div>
  
  <input type="hidden" name="user_id" value="{{ $article->user_id }}">
  
  <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection