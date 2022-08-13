<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use App\Like;



class LikeController extends Controller
{
    // いいね一覧
    public function index(){
        
        $like_items = \Auth::user()->likeItems()->latest()->get();
        
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'like_items' => $like_items,
        ]);
    }
}
