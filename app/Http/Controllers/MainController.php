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
                'page_title'=>"Home",
                'site_title'=>"NOJ",
                'navigation' => "Home",
            ]);
    }
}
