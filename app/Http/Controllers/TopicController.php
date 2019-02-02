<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\NewsTopik;

class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Topic;
    }

    public function getTopic($id=false)
    {
        $return = [];
        $model = $this->model->whereIn('status',['publish','unpublish']);
        if ($id) $model = $model->whereId($id);

        $model = $model->get();
        
        if ($model) {
            $return['status'] = true;
            $return['data'] = $model;
        }

        return $this->apiResponse($return);

    }

    public function postCreateTopic(Request $request, $id=false)
    {   
        $return = [];

        $rules = [
            'title' => 'required',
            'status' => 'required',
        ];

        $message = [
            'required' => 'The :attribute field can not be blank.'          
        ];

        $this->validate($request, $rules, $message);

        $model = $this->model;
        if ($id) $model = $this->model->whereId($id)->first();

        $model->title = $request->title;
        $model->status = $request->status;
        if ($model->save()) {

            $return['status'] = true;
            $return['data'] = $model;
            $return['message'] = 'Data saved';
        }

        return $this->apiResponse($return);

    }

    public function postDeleteTopic($id=false)
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

    


    //
}
