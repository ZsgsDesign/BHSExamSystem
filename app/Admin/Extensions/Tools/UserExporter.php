<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class UserExporter extends AbstractExporter
{
    public function export()
    {
        Excel::create('UserRecord', function($excel) {

            $excel->sheet('record', function($sheet) {
                $rows = collect($this->getData())->map(function ($item) {
                    return $item;
                });
                $sheet->rows($rows);
            });

        })->export('xls');
    }
}
