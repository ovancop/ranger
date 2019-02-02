<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use App\Models\NewsTopic;

class Topic extends Model  {



    protected $table = 'topics';

    protected $fillable = ['title', 'created_at', 'updated_at'];

    protected $hidden = [];


    public function newsTopic()
    {
        return $this->hasMany(NewsTopic::class, 'topic_id');
    }

}