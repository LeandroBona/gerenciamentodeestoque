<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    redirect_with_message('/categorias.php', 'Categoria inválida.', 'error');
}

$stmt = $conexao->prepare('DELETE FROM categoria WHERE id_categoria = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/categorias.php', 'Categoria excluída com sucesso.');
