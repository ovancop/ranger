<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\NewsTopic;

class News extends Model  {


    use SoftDeletes;
    
    protected $table = 'news';

    protected $fillable = ['title', 'brief', 'description', 'created_at', 'updated_at'];

    protected $hidden = [];


    public function newsTopic()
    {
        return $this->hasMany(NewsTopic::class, 'news_id');
    }

}