@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}" />
@endsection

@section('content')

@foreach (['create_name', 'update_name'] as $field)
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
    <form class="menu__form" action="/categories/create" method="post">
      @csrf
      <div class="menu__wrapper">
        <input type="hidden" name="form_type" value="create">
        <input class="menu__input--long"type="text" name="create_name" placeholder="カテゴリを入力してください" value="{{ old('create_name') }}"/>
        <button class="menu__button" type="submit">作成 </button>
      </div>
    </form>
  </div>
  <!-- LIST -->
  <div class="list">
    <div class="list-header">
      <div class="list-header__inner">
        <div class="list-header__input--long">
          カテゴリ
        </div>
        <div class="list-header__input--dummy">
        </div>
      </div>
    </div>
    @foreach($categories as $category)
    <div class="list-content">
      <form class="update-form" action="/categories/update" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="form_type" value="update">
        <input type="hidden" name="id" value="{{$category['id']}}"/>
        <input class="update-form__input--long" type="text" name="update_name" value="{{$category['name']}}"/>
        <button class="update-form__button" type="submit">更新</button>
      </form>
      <form class="remove-form"  action="/categories/delete" method="post">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{$category['id']}}"/>
        <button class="remove-form__button" type="submit">削除</button>
      </form>
    </div>
    @endforeach
    {{ $categories->links('pagination::bootstrap-4') }}

  </div>
</div>
@endsection