<?php

namespace App\Http\Controllers;

//itemsクラスをインポート
use App\Item;
// categoriesクラスをインポート
use App\Category;
// Likeクラスをインポート
use App\Like;

use App\Order;

use Illuminate\Http\Request;
// GoodsRequestモデルをインポート
use App\Http\Requests\GoodsRequest;
// Goods_updateRequestモデルをインポート
use App\Http\Requests\Goods_updateRequest;
// Goods_imageRequestモデルをインポート
use App\Http\Requests\Goods_imageRequest;

class GoodsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    //  出品商品一覧
    public function index()
    {
        
        $items = Item::where('user_id', \Auth::user()->id)->latest()->get();
        
        
    //     $category_ids = $items->pluck('category_id');
    //     // dd($category_ids);
        
    //     // dd($items);
        
    // if(!($category_ids === [])) {
    //     $categories = Category::where('id', $category_ids)->latest()->get();
    //     // dd($categorys);
    // }
        return view('goods.index', [
            'title' => 'の出品商品一覧',
            'items' => $items,
            // 'categories' => $categories,
        ]);
    }

    // 新規出品フォーム
    public function create()
    {
        return view('goods.create', [
            'main_title' => '商品を出品',
            'sub_title' => '商品追加フォーム',
            'categories' => Category::all(),
        ]);
    }

    // 新規出品追加処理
    public function store(GoodsRequest $request)
    {
        // // 画像投稿処理
        $path = '';
        $image = $request->file('image');
        if (isset($image) === true){
        //     // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path,
        ]);
        session()->flash('success', '新規出品しました');
        return redirect()->route('goods.index');
    }

    // 商品詳細
    public function show($id)
    {
        $item = Item::find($id);
        // dd($item);
        return view('goods.show',[
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }

    // 商品情報編集フォーム
    public function edit($id)
    {
        // ルーティングパラメータで渡されたidを利用してインスタンスを取得
        $items = Item::find($id);
        // dd($items);
        return view('goods.edit', [
            'title' => '商品情報の編集',
            'items' => $items,
            'categories' => Category::all(),
            ]);
    }

    // 商品更新処理
    public function update($id, Goods_updateRequest $request)
    {
        $update = Item::find($id);
        $update->update($request->only(['name', 'description', 'price', 'category_id']));
        session()->flash('success', '商品情報を編集しました。');
        return redirect()->route('goods.show', $update);
    }
    
    // 商品画像変更処理
    public function editImage($id){
        
        $item = Item::find($id);
        return view('goods.edit_image', [
            'title' => '商品画像の変更',
            'item' => $item,
            'user_id' => $id,
        ]);
    }
    
    // 画像変更処理
    public function updateImage($id, Goods_imageRequest $request){
        
        $path = '';
        $image = $request->file('image');
        
        if(isset($image) === true){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        $item = Item::find($id);
        
        // 変更前の画像の削除
        if($item->image !== ''){
            // publicディスクから、該当の投稿画像($item->image)を削除
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        
        $item->update([
            'image' => $path, // ファイル名を保存
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('goods.show', $item);
    }
    
    public function toggleLike($id){
        $user = \Auth::user();
        $items = Item::find($id);
        
        if($items->isLikedBy($user)){
            // いいねの取り消し
            $items->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'いいねを取り消しました');
        } else {
            // いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $items->id,
            ]);
            \Session::flash('success', 'いいねしました');
        }
        return redirect()->route('single.top');
    }
    
     // 購入確認画面
    public function indexOrder($id, Request $request){
        // dd($request);
        $purchase = Item::find($id);
        // dd($purchase);
        return view('goods.index_order', [
            'purchase' => $purchase,
            'title' => '購入確認画面',
        ]);
    }
    
    // 購入完了画面
    
    public function buy($id, Request $request){
        
         Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $id,
        ]);
        
        
        $buy = Item::find($id);
        // dd($buy);
        return view('goods.buy', [
            'title' => 'ご購入ありがとうございました',
            'buy' => $buy,
        ]);
    }

    // 商品削除処理
    public function destroy($id)
    {
        $items = Item::find($id);
        
        // 画像の削除
        if($items->image !== ''){
            \Storage::disk('public')->delete($items->image);
        }
        $items->delete();
        \Session::flash('success', '商品を削除しました');
        return redirect()->route('goods.index');
    }
}
