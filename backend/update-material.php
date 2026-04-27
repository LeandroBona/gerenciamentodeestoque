<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$id = post_int('id');
$nome = post_string('material');

if ($id <= 0 || $nome === '') {
    redirect_with_message('/materiais.php', 'Dados inválidos para atualização.', 'error');
}

$stmt = $conexao->prepare('UPDATE material SET nome = ? WHERE id_material = ?');
$stmt->bind_param('si', $nome, $id);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/materiais.php', 'Material atualizado com sucesso.');
