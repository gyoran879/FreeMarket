@extends('layouts.logged_in')

@section('title', $title)

@section('content')

<h1>{{ $title }}</h1>

<ul>
    <li>商品名<br>
        {{ $buy->name }}
    </li>
    
    <li>画像<br>
    <img src="{{ asset('storage/' . $buy->image) }}">
    </li>
    
    <li>カテゴリ<br>
    {{ $buy->category->name }} {{$buy->created_at}}
    </li>
    
    <li>価格:<br>
        {{ $buy->price }}
    </li>
    
    <li>説明<br>
    {{ $buy->description }}
    </li>
</ul>
    <a href="{{ route('single.top', $buy) }}">トップに戻る</a>
@endsection