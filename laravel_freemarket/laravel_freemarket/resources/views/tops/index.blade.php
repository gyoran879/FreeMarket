@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h3>{{ $title }}</h3>
    
    <a href="{{ route('goods.create', \Auth::user()->id) }}">新規出品</a><br>
    <ul>
    @forelse($notUser_recommended_Items as $Item)
        <li class="exhibit_image">
            @if($Item->image !== '')
                <a href="{{ route('goods.show', $Item) }}"><img src="{{ asset('storage/' . $Item->image) }}"></a>
            @else
                <a href="{{ route('goods.show', $Item) }}"><img src="{{ asset('images/ダウンロードnoimage.png') }}"></a>
            @endif
            {{ $Item->description }}
        </li>
        <li>商品名:{{ $Item->name }}{{ $Item->price }}円
            <a class="like_button">{{ $Item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
            <form method="post" class="like" action="{{ route('goods.toggle_like', $Item) }}">
                @csrf
                @method('patch')
            </form>
        </li>
        <li>
            カテゴリ:{{ $Item->category->name}}{{ $Item->created_at }}
        </li>
        
    @if($Item->isSoldOut())
        <p>売り切れ</p>
    @else
        <p>出品中</p>
    @endif
    
    @empty
        <li>商品はありません</li>
    @endforelse
    </ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
<!--    /* global $ */-->
      $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
    })
</script>
@endsection