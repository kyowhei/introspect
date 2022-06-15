<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     //Postに対するリレーション。１対多なので複数形。
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
    public function getByTag(int $limit_count = 5)
    {
        return $this->posts()->with('tag')->orderBy('updated_at','DESC')->paginate($limit_count);
        //$thisには選択されたTagのインスタンスが入っており、そのカテゴリーが持つ投稿を呼び出している。
        //各投稿データからタグ名を取得するので、with()をつなげている。
    }
}
