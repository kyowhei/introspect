<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Postに対するリレーション。１対多なので複数形。
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function getByCategory(int $limit_count = 5)
    {
        return $this->posts()->with('category')->orderBy('updated_at','DESC')->paginate($limit_count);
        //$thisには選択されたCategoryのインスタンスが入っており、そのカテゴリーが持つ投稿を呼び出している。
        //各刀工データからカテゴリー名を取得するので、with()をつなげている。
    }
}
