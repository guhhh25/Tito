<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

//dados q vem do ajax
$tableData = json_decode(file_get_contents('php://input'), true);


$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);


$html = '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Documento PDF</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Resultados:</h1>
    <table>';


$html .= '<tr>';
$html .= '<th>Nome</th>';
$html .= '<th>Idade</th>';
$html .= '<th>Data de Nascimento</th>';
$html .= '<th>Cidade</th>';
$html .= '</tr>';


foreach ($tableData as $rowData) {
    $html .= '<tr>';
    foreach ($rowData as $cellData) {
       
        if (strtotime($cellData) !== false) {
            $cellData = date('d/m/Y', strtotime($cellData));
        }
        $html .= '<td>' . htmlspecialchars($cellData) . '</td>';
    }
    $html .= '</tr>';
}

$html .= '</table></body></html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();


$dompdf->stream("dados.pdf", array("Attachment" => false));
?>