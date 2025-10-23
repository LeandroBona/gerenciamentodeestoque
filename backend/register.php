<?php

include "config.php";

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

$sql = "INSERT INTO usuario (nome, telefone) VALUES (?, ?)";
$stmt = $conexao->prepare($sql);
$stmt -> bind_param("ss", $nome,  $telefone );

if($stmt->execute()){
    
}else{
    echo "erro ao cadastrar material" . $conexao->error;

}

$stmt->close();
$conexao->close();

?>
