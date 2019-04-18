<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\URL;

 class UploadUserButton extends AbstractTool
 {

   public function __construct()
   {
       $this->url = URL::current().'/upload';
   }


    public function render()
    {
        $options = [
            $this->url   => '导入数据',
        ];

        return view('tools.UserUploadButton', compact('options'));
    }
}
