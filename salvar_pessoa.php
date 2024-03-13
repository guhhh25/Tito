<?php

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['nome']) && !empty($_POST['idade']) && !empty($_POST['data_nascimento']) && !empty($_POST['id_cidade'])) {
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $dataNascimento = $_POST['data_nascimento'];
        $idCidade = $_POST['id_cidade'];

        try {
            $query = $dbh->prepare("INSERT INTO Pessoa (nome, idade, dataNascimento, id_cidade) VALUES (:nome, :idade, :dataNascimento, :id_cidade)");
            $query->bindParam(':nome', $nome);
            $query->bindParam(':idade', $idade);
            $query->bindParam(':dataNascimento', $dataNascimento);
            $query->bindParam(':id_cidade', $idCidade);
            $query->execute();

        
            echo '<script>alert("Pessoa cadastrada com sucesso!");</script>';
            echo '<a href="index.php" class="btn btn-danger mb-2" >Voltar para o Index</a>';
            exit(); 
        } catch (PDOException $e) {

            echo 'Erro ao cadastrar pessoa: ' . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>