<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TestModel;
use Illuminate\Http\Request;
use Auth;


class TestController extends Controller
{
    public function detail($tid)
    {
        $testModel= new TestModel();
        $testProb=$testModel->getProb($tid);
        return view('test.detail', [
            'page_title'=>"测试",
            'site_title'=>"贝尔英才学院诚信考试系统",
            'navigation' => "Home",
            "testProb"=>$testProb
        ]);
    }
}
