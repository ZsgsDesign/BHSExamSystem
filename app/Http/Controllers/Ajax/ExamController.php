<?php

namespace App\Http\Controllers\Ajax;

use App\Models\ExamModel;
use App\Models\ResponseModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\ProcessSubmission;
use Auth;

class ExamController extends Controller
{
    public function getHistory(Request $request)
    {
        $request->validate([
            'eid' => 'required|integer'
        ]);
        $all_data=$request->all();
        $examModel=new ExamModel();
        return Auth::check()?ResponseModel::success(200, null, $examModel->getHistory($all_data["eid"],Auth::user()->id)):ResponseModel::err(2001);
    }
}
