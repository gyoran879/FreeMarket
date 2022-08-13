<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// itemsモデルをインポート
use App\Item;
class SingleAction extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    function __invoke(){
        // dd('aaa');
        $user = \Auth::user();
        $notUser_recommended_Items = Item::recommendItem($user->id)->get();
        $title = '息をするように、買おう。';
        return view('tops.index', [
            'title' => $title,
            'notUser_recommended_Items' => $notUser_recommended_Items,
        ]);
    }
}
