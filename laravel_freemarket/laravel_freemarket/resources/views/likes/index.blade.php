@extends('layouts.logged_in')

@section('content')
    <h1>{{ $title }}</h1>
    
    <ul class="likes">
        @forelse($like_items as $item)
            <li>
                {{ $item->image }}
                @if($item->image !== '')
                    <a href="{{ route('goods.show', $item) }}"><img src="{{ asset('storage/' . $item->image) }}"></a>
                @else
                    <a href="{{ route('goods.show', $item) }}"><img src="{{ asset('images/ダウンロードnoimage.png') }}"></a>
                @endif
                
                {{ $item->description }}
            </li>
            <li>
                商品名:{{ $item->name }} {{$item->price }}円
            </li>
            <li>
                カテゴリ:{{ $item->category->name }}{{ $item->created_at }}
            </li>
            
            @if($item->isSoldOut())
                <p>売り切れ</p>
            @else
                <p>出品中</p>
            @endif
        @empty
            <li>商品はありません</li>
        @endforelse
    </ul>
@endsection