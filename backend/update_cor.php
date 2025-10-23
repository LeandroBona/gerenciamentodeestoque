<?php
include 'config.php';

if(isset($_POST['id']) && isset($_POST['color'])) {
    $id = $_POST['id'];
    $nome = $_POST['color'];

    $sql = "UPDATE cor SET nome = '$nome' WHERE id_cor = $id";

    if($conexao->query($sql) === TRUE) {
        header("Location: ../cores.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    echo "Dados inválidos.";
}
