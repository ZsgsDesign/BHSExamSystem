<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamModel;
use Illuminate\Http\Request;
use Auth,Redirect;


class ExamController extends Controller
{
    public function detail($eid)
    {
        $examModel=new ExamModel();
        $examDetail=$examModel->detail($eid, Auth::user()->id);
        if(is_null($examDetail)){
            return Redirect::route('home');
        }
        return view('exam.detail', [
                'page_title'=>"详情",
                'site_title'=>"贝尔英才学院诚信考试系统",
                'navigation' => "Home",
                'detail'=>$examDetail
            ]);
    }

    public function start($eid)
    {
        $examModel=new ExamModel();
        $examDetail=$examModel->detail($eid, Auth::user()->id);
        if(is_null($examDetail)){
            return Redirect::route('home');
        }
        $tid=$examModel->startTest($eid, Auth::user()->id);
        return Redirect::route('test_detail', [
            "tid"=>$tid
        ]);
    }
}
