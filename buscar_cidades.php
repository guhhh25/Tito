<?php

require_once 'connection.php';

$cidades = $dbh->query("SELECT id, nome FROM CIDADE");
$options = "<option value=''>Selecione a cidade</option>";
while ($cidade = $cidades->fetch(PDO::FETCH_ASSOC)) {
    $options .= "<option value='{$cidade['id']}'>{$cidade['nome']}</option>";
}

echo $options;
?>