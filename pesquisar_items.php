<?php
require_once 'connection.php';


function filtrarPessoas($nome) {
    global $dbh;
  
    $sql = "SELECT Pessoa.*, Cidade.Nome AS NomeCidade 
    FROM Pessoa 
    LEFT JOIN Cidade ON Pessoa.id_cidade = Cidade.ID 
    WHERE 1";

    if (!empty($nome)) {
        $sql .= " AND Pessoa.Nome LIKE :nome";
    }
  
    $stmt = $dbh->prepare($sql);

  
    if (!empty($nome)) {
        $nome = "%{$nome}%"; 
        $stmt->bindParam(':nome', $nome);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Não consegui fazer o filtro funcionar corretamente por conta disso, não estava conseguindo capturar o input pelo PHP, então filtrei todo os valores pelo JS.
    $nome = isset($_GET['nomePessoa']) ? $_GET['nomePessoa'] : "";

    $pessoasFiltradas = filtrarPessoas($nome);


    ob_clean();

    header('Content-Type: application/json');
    echo json_encode($pessoasFiltradas);
}
?>