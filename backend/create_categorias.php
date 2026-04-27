<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$categoria = post_string('categoria');
if ($categoria === '') {
    redirect_with_message('/categorias.php', 'Informe o nome da categoria.', 'error');
}

$stmt = $conexao->prepare('INSERT INTO categoria (nome) VALUES (?)');
$stmt->bind_param('s', $categoria);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/categorias.php', 'Categoria cadastrada com sucesso.');
