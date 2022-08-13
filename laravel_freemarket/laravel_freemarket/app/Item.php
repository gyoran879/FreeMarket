<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function order(){
        return $this->hasOne('App\Order');
    }
    
    public function scopeRecommendItem($query, $self_id){
        return $query->where('user_id', '!=', $self_id)->latest();
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function likedUsers(){
        return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikedBy($user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }
    public function isSoldOut(){
        return $this->hasMany('App\Order')->exists();
    }
    
}
