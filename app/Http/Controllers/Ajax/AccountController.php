<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\ResponseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AccountController extends Controller
{
    public function changePassword(Request $request){
        if(!$request->has('old_password') || !$request->has('new_password') || !$request->has('confirm_password')){
            return ResponseModel::err(1003);
        }
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');
        if($new_password != $confirm_password){
            return ResponseModel::err(2004);
        }
        if(strlen($new_password) < 8 || strlen($old_password) < 6){
            return ResponseModel::err(1006);
        }
        $user = Auth::user();
        if(!Hash::check($old_password, $user->password)){
            return ResponseModel::err(2005);
        }
        $user->password = Hash::make($new_password);
        $user->save();
        return ResponseModel::success();
    }
}
