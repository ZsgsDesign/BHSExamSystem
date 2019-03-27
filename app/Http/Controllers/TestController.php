<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class TestController extends Controller
{
    public function detail(Request $request)
    {
        return view('test.detail', [
                'page_title'=>"测试",
                'site_title'=>"贝尔英才学院诚信考试系统",
                'navigation' => "Home",
            ]);
    }
}
