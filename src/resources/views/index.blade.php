@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection


@section('content')
@if (session('message'))
<div class="alert__message--success">
  {{session('message')}}
</div>
@endif
@foreach (['create_content', 'search_content', 'update_content'] as $field)
  @error($field)
    <div class="alert__message--fail">
      {{ $message }}
    </div>
  @enderror
@endforeach
@foreach (['create_category_name', 'search_category_name', 'update_category_name'] as $field)
  @error($field)
    <div class="alert__message--fail">
      {{ $message }}
    </div>
  @enderror
@endforeach
<div class="content">
<!-- CREATE -->
  <div class="menu">
    <div class="menu__header">
      新規作成
    </div>
    <form class="menu__form" action="/todos/create" method="post">
      @csrf
      <div class="menu__wrapper">
        <input type="hidden" name="form_type" value="create">
        <input class="menu__input--short"type="text" name="create_content" placeholder="Todo入力" value="{{ old('create_content') }}"/>
        <select class="menu__select" name="create_category_name">
          <option value="">カテゴリ選択</option>
          @foreach ($categories as $category)
          <option value="{{ $category->name }}" {{ old('create_category_name') == $category->name ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          @endforeach
        </select>
        <button class="menu__button" type="submit">作成 </button>
      </div>
    </form>
  </div>
  <!-- SEARCH -->
  <div class="menu">
    <div class="menu__header">
      検索
    </div>
    <form class="menu__form" action="/todos/search" method="get">
      @csrf
      <div class="menu__wrapper">
        <input type="hidden" name="form_type" value="search">
        <input class="menu__input--short"type="text" name="keyword" placeholder="検索ワード" value="{{ old('keyword') }}"/>
        <select class="menu__select" name="search_category_name">
          <option value="">カテゴリ選択</option>
          @foreach ($categories as $category)
          <option value="{{ $category->name }}" {{ old('search_category_name') == $category->name ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          @endforeach
        </select>
        <button class="menu__button" type="submit">検索 </button>
      </div>
    </form>
  </div>
  <!-- LIST -->
  <div class="list">
    <div class="list-header">
      <div class="list-header__inner">
        <div class="list-header__input--short">
          Todo
        </div>
        <div class="list-header__input--short">
          カテゴリ
        </div>
        <div class="list-header__input--dummy">
        </div>
      </div>
    </div>
    @foreach($todos as $todo)
    <div class="list-content">
      <form class="update-form" action="/todos/update" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="form_type" value="update">
        <input type="hidden" name="id" value="{{$todo['id']}}"/>
        <input class="update-form__input--short" type="text" name="update_content" value="{{$todo['content']}}"/>
        <select class="update-form__input--short" name="update_category_name">
          <option value="">カテゴリを選択してください</option>
          @foreach ($categories as $category)
          <option value="{{ $category->name }}" {{ $todo->category->name == $category->name ? 'selected' : '' }}>
              {{ $category->name }}
          </option>
          @endforeach
        </select>
        <button class="update-form__button" type="submit">更新</button>
      </form>
      <form class="remove-form"  action="/todos/delete" method="post">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{$todo['id']}}"/>
        <button class="remove-form__button" type="submit">削除</button>
      </form>
    </div>
    @endforeach
    {{ $todos->links('pagination::bootstrap-4') }}
  </div>
</div>
@endsection