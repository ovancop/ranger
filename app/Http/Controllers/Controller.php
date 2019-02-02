<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public function apiResponse($data=[])
    {
    	$return['status'] = isset($data['status']) ? $data['status'] : false;
        $return['data'] = isset($data['data']) ? $data['data'] : null;
    	$return['message'] = isset($data['message']) ? $data['message'] : null;

    	return $return;
    }
}
