<?php

namespace App\Http\Controllers\Ajax;

use App\Models\TestModel;
use App\Models\ResponseModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\ProcessSubmission;
use Auth;

class TestController extends Controller
{
    public function submitAns(Request $request)
    {
        $request->validate([
            'tid' => 'required|integer',
            'ans' => 'array',
        ]);

        $all_data=$request->all();

        if(empty($all_data["ans"]))$all_data["ans"]=[];

        $testModel=new TestModel();
        $testBasic=$testModel->basic($all_data["tid"]);
        if($testBasic["uid"]!=Auth::user()->id){
            return ResponseModel::err(2001);
        } else {
            return ResponseModel::success(200, null, $testModel->submitAns($all_data["tid"],$all_data["ans"]));
        }
    }
}
