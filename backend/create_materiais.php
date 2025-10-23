<?php

include 'config.php';

$material = $_POST['material'];

$sql = "INSERT INTO material (nome) VALUES (?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('s', $material);

if($stmt->execute()){
    echo "<h1> material cadastrada com sucesso </h1>";
}else{
    echo "Erro ao cadastrar a material" . $conexao->error;
}

$stmt->close();
$conexao->close();

?>