<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class AccountController extends Controller
{
    public function settings()
    {
        return view('account.settings', [
                'page_title'=>"修改密码",
                'site_title'=>"贝尔英才学院诚信考试系统",
                'navigation'=>"Settings"
            ]);
    }

}
