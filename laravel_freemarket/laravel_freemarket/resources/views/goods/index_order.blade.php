@extends('layouts.logged_in')

@section('title', $title)

@section('content')

    <form method="post" action="{{ route('purchase.create', $purchase) }}" enctype="multipart/form-data">
        @csrf
    <ul>
        <li>商品名<br>
            {{ $purchase->name }}
        </li>
        
        <li>
            画像<br>
            <img src="{{ asset('storage/' . $purchase->image) }}">
        </li>
        
        <li>
            カテゴリ:<br>
            {{ $purchase->category->name }} {{$purchase->created_at}}
        </li>
        
        <li>価格:<br>
            {{ $purchase->price }}
        </li>
        
        <li>説明<br>
            {{ $purchase->description }}
        </li>
        
        <input type="submit" value="内容を確認し、購入する">
    </ul>
    </form>
@endsection