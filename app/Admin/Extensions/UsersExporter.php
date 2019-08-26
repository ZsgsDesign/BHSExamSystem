<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;

class UsersExporter extends ExcelExporter
{
    protected $fileName = 'score.xlsx';

    protected $columns = [
        'id'      => 'ID',
        'title'   => '标题',
        'content' => '内容',
    ];
}
