@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    
    <form method="POST" action="{{ route('purchase.index', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
    <ul>
        
       <li>商品名<br>
           {{ $item->name }}
       </li>
       
       <li>画像<br>
           <img src="{{ asset('storage/' . $item->image) }}">
       </li>
       
       <li>カテゴリ:{{ $item->category->name }}{{ $item->created_at }}<br>
       </li>
       
       <li>価格:<br>
            {{ $item->price }}円
       </li>
       
       <li>説明<br>
            {{ $item->description }}
        </li>
        
         @if($item->isSoldOut())
         <p>売り切れ</p>
         @else
         <input type="submit" value="購入する">
         @endif
        
    </ul>
    </form>
@endsection
