@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection


@section('content')
@if (session('message'))
<div class="header__label--success">
  {{session('message')}}
</div>
@endif
@error('content')
<div class="header__label--fail">
  {{ $message }}
</div>
@enderror
<div class="todo-content">
  <div class="todo-create">
    <form class="create-form" action="/todos" method="post">
      @csrf
      <div class="create-form-title">
        <input class="create-form-title__input"type="text" name="content" placeholder="" value=""/>
        <button class="create-form-title__button" type="submit">作成 </button>
      </div>
    </form>
  </div>
  <div class="todo-list">
    <div class="todo-list-header">
      Todo
    </div>
    <!-- for debug
    @php
      var_dump($todos);
    @endphp
    -->
    @foreach($todos as $todo)
    <div class="todo-list-content">
      <form class="update-form" action="/todos/update" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{$todo['id']}}"/>
        <input class="update-form__input" type="text" name="content" placeholder="" value="{{$todo['content']}}"/>
        <button class="update-form__button" type="submit">更新</button>
      </form>
      <form class="remove-form"  action="/todos/delete" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{$todo['id']}}"/>
        <button class="remove-form__button" type="submit">削除</button>
      </form>
    </div>
    @endforeach
      <!-- {{ $todos->links() }} -->
      {{ $todos->links('pagination::bootstrap-4') }}

  </div>
</div>
@endsection