<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$id = post_int('id');
$nome = post_string('categoria');

if ($id <= 0 || $nome === '') {
    redirect_with_message('/categorias.php', 'Dados inválidos para atualização.', 'error');
}

$stmt = $conexao->prepare('UPDATE categoria SET nome = ? WHERE id_categoria = ?');
$stmt->bind_param('si', $nome, $id);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/categorias.php', 'Categoria atualizada com sucesso.');
