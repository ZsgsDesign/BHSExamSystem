<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class MainController extends Controller
{
    public function home(Request $request)
    {
        return view('home', [
                'page_title'=>"首页",
                'site_title'=>"贝尔英才学院诚信考试系统",
                'navigation' => "Home",
            ]);
    }
}
