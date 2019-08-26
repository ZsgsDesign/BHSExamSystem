<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public $table="users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'name', 'email', 'password', 'avatar', 'contest_account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden=[
        'password', 'remember_token',
    ];

    public static function findExam($uid,$eid){
        $basic=DB::table("test")->where(["eid"=>$eid,"uid"=>$uid])->orderBy('score', 'desc')->first();
        return empty($basic)?"/":$basic["score"];
    }

    public static function exams(){
        return DB::table("exam")->where(["available"=>1])->get()->all();
    }
    public function export()
    {
        $userList=DB::table("users")->select("name","email as SID")->get()->all();
        $exams=UserModel::exams();
        foreach ($userList as &$u) {
            foreach ($exams as $e) {
                $u[]=UserModel::findExam($this->id, $e["eid"])["score"];
            }
        }
    }
}
