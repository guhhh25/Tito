<?php

$tableData = json_decode(file_get_contents('php://input'), true);

$txtContent = '';
foreach ($tableData as $rowData) {
    $txtContent .= implode(',', $rowData) . "\n";
}

$fileName = 'dados.txt';
$file = fopen($fileName, 'w');
fwrite($file, $txtContent);
fclose($file);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
readfile($fileName);

unlink($fileName);