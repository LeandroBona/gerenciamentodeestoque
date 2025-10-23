<?php
include 'config.php';

if(isset($_POST['id']) && isset($_POST['categoria'])) {
    $id = $_POST['id'];
    $nome = $_POST['categoria'];

    $sql = "UPDATE categoria SET nome = '$nome' WHERE id_categoria = $id";

    if($conexao->query($sql) === TRUE) {
        header("Location: ../categorias.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    echo "Dados inválidos.";
}
