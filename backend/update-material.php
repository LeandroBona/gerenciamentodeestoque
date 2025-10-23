<?php
include 'config.php';

if(isset($_POST['id']) && isset($_POST['material'])) {
    $id = $_POST['id'];
    $nome = $_POST['material'];

    $sql = "UPDATE material SET nome = '$nome' WHERE id_material = $id";

    if($conexao->query($sql) === TRUE) {
        header("Location: ../materiais.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
} else {
    echo "Dados inválidos.";
}
