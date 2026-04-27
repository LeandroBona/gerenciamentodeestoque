<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_message('/caixa.php', 'Método inválido.', 'error');
}

$valor = post_float('valor');
$motivo = post_string('motivo');

if ($valor <= 0 || $motivo === '') {
    redirect_with_message('/caixa.php', 'Preencha todos os campos corretamente.', 'error');
}

$stmt = $conexao->prepare('INSERT INTO saidacaixa (valor, motivo) VALUES (?, ?)');
$stmt->bind_param('ds', $valor, $motivo);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/caixa.php', 'Saída de caixa registrada com sucesso.');
