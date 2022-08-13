@extends('layouts.logged_in')

@section('content')
    <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    @if($item->image !== '')
        <img src="{{ \Storage::url($item->image) }}">
    @else
        <img src="{{ asset('images/ダウンロードnoimage.png') }}">
    @endif
    
    <form method="post" action="{{ route('goods.update_image', $user_id) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="更新">
    </form>
@endsection