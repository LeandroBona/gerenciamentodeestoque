<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    redirect_with_message('/cores.php', 'Cor inválida.', 'error');
}

$stmt = $conexao->prepare('DELETE FROM cor WHERE id_cor = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/cores.php', 'Cor excluída com sucesso.');
