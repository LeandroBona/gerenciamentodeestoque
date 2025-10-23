<?php

include 'config.php';

$categoria = $_POST['categoria'];

$sql = "INSERT INTO categoria (nome) VALUES (?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('s', $categoria);

if($stmt->execute()){
    echo "<h1> categoria cadastrada com sucesso </h1>";
}else{
    echo "Erro ao cadastrar a categoria" . $conexao->error;
}

$stmt->close();
$conexao->close();

?>