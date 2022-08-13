@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<!--{$goods->users)->name}}-->
    <h1>{{ \Auth::user()->name }}{{$title}}</h1>
    <a href="{{ route('goods.create', \Auth::user()->id) }}">新規出品</a>
    <ul>
        @forelse($items as $item)
        <li>
            @if($item->image !== '')
               <a href="{{ route('goods.show', $item) }}"><img src="{{ asset('storage/' . $item->image) }}"></a>
            @else
               <a href="{{ route('goods.show', $item) }}"><img src="{{ asset('images/ダウンロードnoimage.png') }}"></a>
            @endif
            {{ $item->description}}
        </li>
        <li>
            商品名:{{ $item->name }}{{ $item->price }}円
        </li>
        
        <li>カテゴリ:{{ $item->category->name }}{{ $item->created_at }}</li>
         <li><a href="{{ route('goods.edit', $item->id) }}">編集</a> 
         <a href="{{ route('goods.edit_image', $item->id) }}">画像を変更</a>
         <a href="{{ route('goods.show', $item->id) }}">詳細</a></li>
    
         <form class="delete" method="post" action="{{ route('goods.destroy', $item->id) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="削除">
         </form>
         @if($item->isSoldOut())
         <p>売り切れ</p>
         @else
         <p>出品中</p>
         @endif
        @empty
        <p>出品している商品はありません。</p>
        @endforelse
        
    </ul>
  
@endsection