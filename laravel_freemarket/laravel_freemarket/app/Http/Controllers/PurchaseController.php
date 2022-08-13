<?php

namespace App\Http\Controllers;

//itemsクラスをインポート
use App\Item;
// categoriesクラスをインポート
use App\Category;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
    }
    
   
}
