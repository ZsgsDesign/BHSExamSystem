<?php

namespace App\Admin\Extensions;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use App\Models\UserModel;

class UsersExporter extends AbstractExporter
{
    public function export()
    {
        $database = $this->getExportData();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($database, NULL, 'A1' );
        $writer = new Xlsx($spreadsheet);

        $filename = 'score.xlsx';

        $headers = [
            'Content-Encoding'    => 'UTF-8',
            'Content-Type'        => 'application/vnd.ms-excel;charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        response()->stream(function() use ($writer){
            $writer->save('php://output');
        }, 200, $headers)->send();

        exit;
    }

    public function getExportData()
    {
        return UserModel::export();
    }
}
