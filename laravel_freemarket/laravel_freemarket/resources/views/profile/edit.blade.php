@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    
    <form method="post" action="{{ route('profile.update', $update->id) }}">
        @csrf
        @method('PATCH')
        <div>
            <label>
                名前:<br>
                <input type="text" name="name" value="{{ old('name', $update->name) }}">
            </label>
        </div>
        
        <div>
            <label>
                プロフィール:<br>
                <textarea name="introduction">{{ old('introduction', $update->introduction) }}</textarea>
            </label>
        </div>
        <div>
            <input type="submit" value="更新">
        </div>
    </form>
@endsection