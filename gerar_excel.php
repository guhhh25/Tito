<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function formatarData($data)
{

    if (strpos($data, '-') !== false) {
        $partesData = explode('-', $data);
        return $partesData[2] . '/' . $partesData[1] . '/' . $partesData[0];
    }
    return $data;
}


$tableData = json_decode(file_get_contents('php://input'), true);

$spreadsheet = new Spreadsheet();

$spreadsheet->getProperties()
    ->setCreator("Nome do Criador")
    ->setLastModifiedBy("Nome do Modificador")
    ->setTitle("Título do Documento")
    ->setSubject("Assunto do Documento")
    ->setDescription("Descrição do Documento")
    ->setKeywords("palavras-chave, separadas, por, vírgula")
    ->setCategory("Categoria do Documento");


$sheet = $spreadsheet->getActiveSheet();
$columns = ['Nome', 'Idade', 'Data de Nascimento', 'Cidade'];
$column = 'A';

foreach ($columns as $columnName) {
    $sheet->setCellValue($column . '1', $columnName);
    $column++;
}

$row = 2;
foreach ($tableData as $rowData) {
    $column = 'A';
    foreach ($rowData as $cellData) {
      
        // formata data 
        if (strpos($cellData, '-') !== false) {
            $cellData = formatarData($cellData);
        }
        $sheet->setCellValue($column . $row, $cellData);
        $column++;
    }
    $row++;
}


$sheet->setTitle('Pessoas');


$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pessoas.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');