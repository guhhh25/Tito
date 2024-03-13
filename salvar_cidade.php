<?php

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cidadeNome = $_POST["nome"];

    try {
        $stmtInsert = $dbh->prepare("INSERT INTO CIDADE (Nome) VALUES (:nome)");
        $stmtInsert->bindParam(':nome', $cidadeNome);
        $stmtInsert->execute();
        
        echo '<script>alert("Cidade salva com sucesso!");</script>';
            echo '<a href="index.php" class="btn btn-danger mb-2" >Voltar para o Index</a>';
    } catch (PDOException $e) {

        echo 'Erro de conexão: ' . $e->getMessage();
    }
} else {

    header("Location: cadastrar_cidade.php");
    exit();
}
?>