<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valor = $_POST['valor'] ?? 0;
    $motivo = trim($_POST['motivo'] ?? '');

    if ($valor > 0 && $motivo !== '') {
        $stmt = $conexao->prepare("INSERT INTO saidacaixa (valor, motivo) VALUES (?, ?)");
        $stmt->bind_param("ds", $valor, $motivo);

        if ($stmt->execute()) {
            header("Location: ../caixa.php?msg=sucesso");
            exit;
        } else {
            echo "Erro ao registrar saída: " . $conexao->error;
        }
    } else {
        echo "Preencha todos os campos corretamente.";
    }
} else {
    header("Location: ../caixa.php");
    exit;
}
?>
