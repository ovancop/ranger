<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsTopic;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new News;
    }

    public function getNews()
    {
        $return = [];
        $model = $this->model->whereStatus('publish')->with('newsTopic.topic')->get();
        if ($model) {
            $return['status'] = true;
            $return['data'] = $model;
        }

        return $this->apiResponse($return);

    }

    public function postCreateNews(Request $request, $id=false)
    {   
        $return = [];

        $rules = [
            'title' => 'required',
            'brief' => 'required',
            'description' => 'required',
            'status' => 'required',
            'topic_id' => 'required',
        ];

        $message = [
            'required' => 'The :attribute field can not be blank.'          
        ];

        $this->validate($request, $rules, $message);

        $model = $this->model;
        if ($id) $model = $this->model->whereId($id)->first();

        $model->title = $request->title;
        $model->brief = $request->brief;
        $model->description = $request->description;
        $model->status = $request->status;
        if ($model->save()) {

            if ($request->has('topic_id') && is_array($request->topic_id)) {

                $removeTopic = NewsTopic::whereNewsId($model->id)->delete();

                foreach ($request->topic_id as $key => $value) {
                    $topic = new NewsTopic;
                    $topic->news_id = $model->id;
                    $topic->topic_id = $value;
                    $topic->save();
                }
            }

            $return['status'] = true;
            $return['data'] = $model;
            $return['message'] = 'Data saved';
        }

        return $this->apiResponse($return);

    }

    public function postDeleteNews($id=false)
    {   
        $return = [];

        $model = $this->model->findOrFail($id);
        if ($model) {
            $model->delete();
            $return['status'] = true;
            $return['message'] = 'News Deleted';
        }

        return $this->apiResponse($return);

    }

    
}
