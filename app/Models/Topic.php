<?php

namespace App\Models;
use App\Models\User;
use App\Models\Reply;
use App\Models\Category;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function replies()
    {
      return $this->hasMany(Reply::class);
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

    public function link($params=[]){
      return route('topics.show',array_merge([$this->id,$this->slug],$params));
    }

   /*
   * 获取这篇文章的评论以parent_id来分组
   * @return static
   */
  public function getReplies()
  {
      return $this->replies()->with('user')->get()->groupBy('parent_id');
  }
  
}
