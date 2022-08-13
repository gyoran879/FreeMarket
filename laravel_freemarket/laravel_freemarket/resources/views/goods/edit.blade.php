@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('goods.update', $items->id) }}">
        @csrf
        @method('patch')
        <div>
            <label>
                商品名:<br>
                <input type="text" name="name" value="{{ $items->name }}">
            </label>
        </div>
        
        <div>
            <label>
                商品説明:<br>
                <textarea name="description"><?php echo $items->description; ?></textarea>
            </label>
        </div>
        
        <div>
            <label>
                価格:<br>
                <input type="number"  name="price" value="{{ $items->price }}">
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
        
        <input type="submit" value="更新">
    </form>
@endsection