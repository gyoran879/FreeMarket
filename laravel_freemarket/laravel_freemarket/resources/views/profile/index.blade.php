@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h2>{{ $title }}</h2>
    
    <ul>
        <li>
            @if($user_information->image !== '')
                <img src="{{ asset('storage/' . $user_information->image) }}">
            @else
                <img src="{{ asset('images/ダウンロードnoimage.png') }}">
            @endif
            
            <a href="{{ route('profile.edit_image', $user_information->id) }}">画像を変更</a><br>
            名前: {{ $user_information->name }} 一言: {{ $user_information->introduction }} <a href="{{ route('profile.edit', $user_information->id) }}">プロフィール編集</a><br>
            
            出品数:{{$user_exhibit}}
        </li>
    </ul>
    
    <h2>購入履歴</h2>
    @forelse($buy_history as $buy)
    <ul>
        <li><a href="{{ route('goods.show', $buy) }}">{{$buy->name}}:</a> {{$buy->price}}円 出品者 {{$buy->User->name}}さん</li>
    </ul>
    @empty
        <p>購入履歴はありません。</p>
    @endforelse
@endsection