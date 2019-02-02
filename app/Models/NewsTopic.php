<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Models\Topic;

class NewsTopic extends Model  {



    protected $table = 'news_topics';

    protected $hidden = [];


    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}