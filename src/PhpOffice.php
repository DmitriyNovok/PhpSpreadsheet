<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PhpOffice
{
    public static function export()
    {
        $report = [
            [
                'Mercedes-Benz',
                'Moscow, Russia',
                'In process',
            ],
            [
                'BMW X5',
                'Saint Petersburg, Russia',
                'Completed',
            ],
            [
                'Audi A4',
                'Sochi, Russia',
                'Awaiting payment',
            ],
        ];

        $cells = [
            'A1' => 'Vehicle',
            'B1' => 'Place',
            'C1' => 'Status',
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $value) {
            $sheet->setCellValue($key, $value);
        }

        $spreadsheet->getActiveSheet()->fromArray($report, null, 'A2');

        $writer = new Xlsx($spreadsheet);
        \header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        \header('Content-Disposition: attachment; filename="Example_export.xlsx"');
        \header('Cache-Control: max-age=0');
        $writer->save('php://output');

        exit();
    }
}