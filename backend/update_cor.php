<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$id = post_int('id');
$nome = post_string('color');

if ($id <= 0 || $nome === '') {
    redirect_with_message('/cores.php', 'Dados inválidos para atualização.', 'error');
}

$stmt = $conexao->prepare('UPDATE cor SET nome = ? WHERE id_cor = ?');
$stmt->bind_param('si', $nome, $id);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/cores.php', 'Cor atualizada com sucesso.');
