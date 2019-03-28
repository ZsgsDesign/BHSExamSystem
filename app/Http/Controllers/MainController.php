<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamModel;
use Illuminate\Http\Request;
use Auth;


class MainController extends Controller
{
    public function home(Request $request)
    {
        $examModel=new ExamModel();
        $examList=$examModel->list(Auth::user()->id);
        return view('home', [
                'page_title'=>"首页",
                'site_title'=>"贝尔英才学院诚信考试系统",
                'navigation' => "Home",
                'exams'=> $examList
            ]);
    }
}
