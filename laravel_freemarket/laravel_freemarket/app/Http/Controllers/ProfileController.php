<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Userモデルをインポート
use App\User;
// Itemモデルをインポート
use App\Item;
// Orderモデルをインポート
use App\Order;

//Profileリクエストモデルをインポート
use App\Http\Requests\ProfileRequest;

//Profile_imageリクエストモデルをインポート
use App\Http\Requests\Profile_imageRequest;

class ProfileController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
    }
    
    // プロフィール画面
    public function index()
    {
       
        $user_information = \Auth::user();
        $user_exhibit = $user_information->items()->count();
        // dd($user_exhibit);
        $buy_history = $user_information->orderItems;
        // dd($buy_history);
        
        return view('profile.index', [
            'title' => 'プロフィール',
            'user_information' => $user_information,
            'user_exhibit' => $user_exhibit,
            'buy_history' => $buy_history,
        ]);
    }
    
    // プロフィール編集画面
    public function edit(){
        
        $update = User::find(\Auth::user()->id);
        
        return view('profile.edit', [
            'title' => 'プロフィール編集',
            'update' => $update,
            ]);
    }
    
    //プロフィール更新実施
    public function update(ProfileRequest $request) {
        
        $update = User::find(\Auth::user()->id);
        $update->update($request->only(['name', 'introduction']));
        session()->flash('success', '編集しました。');
        return redirect('/profile');
    }
    
    public function editImage($user_id) {
        
        $update_image = User::find($user_id);
        
        return view('profile.edit_image',[
            'title' => 'プロフィール画像編集',
            'user_id' => $user_id,
            'update_image' => $update_image,
        ]);
    }
    
    public function updateImage($id, Profile_imageRequest $request){
        
        // 画像投稿処理
        $path = '';
        $image = $request->file('image');
        
        if(isset($image) === true){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        $user = User::find($id);
        
        // 変更前の画像の削除
        if($user->image !== ''){
            // publicディスクから、該当の投稿画像($user->image)を削除
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        
        $user->update([
            'image' => $path, // ファイル名を保存
            ]);
            
            session()->flash('success', '画像を変更しました');
            return redirect()->route('profile.index');
    }
}
