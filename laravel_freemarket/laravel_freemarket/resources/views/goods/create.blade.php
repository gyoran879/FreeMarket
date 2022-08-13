@extends('layouts.logged_in')

@section('main_title', $main_title)

@section('content')
    <h1>{{ $main_title }}</h1>
    <h2>{{ $sub_title }}</h2>
    <form method="POST" action="{{ route('goods.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>
                商品名:
                <input type="text" name="name">
            </label>
        </div>
        <div>
            <label>
                商品説明:
                <textarea rows="10" cols="60" name="description"></textarea>
            </label>
        </div>
        <div>
            <label>
                価格:
                <input type="number" name="price"> 
            </label>
        </div>
        <div>
            <label>
                カテゴリー:<br>
                <select name="category_id">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div>
        
        <input type="submit" value="出品">
    </form>
@endsection
