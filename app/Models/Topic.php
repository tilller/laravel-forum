<?php

namespace App\Models;
use App\Models\User;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function scopeWithOrder($query,$order)
    {
      switch($order){
        case 'recent':
               $query=$this->recent();
               break;
        default:
               $query=$this->recentReplied();
               break;
      }
      //预加载防止N+1问题
      return $query->with('user','category');
    }
    public function scopeRecentReplied($query){
      //当话题有新回复时。我们将编写逻辑来更新话题模型的reply_count属性,
      //此时会自动触发框架对数据模型updated_at时间戳的自动更新
      return $query->orderBy('updated_at','desc');
    }
    public function scopeRecent($query){
      //按照创建时间排序
      return $query->orderBy('created_at','desc');
    }
}