<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$material = post_string('material');
if ($material === '') {
    redirect_with_message('/materiais.php', 'Informe o material.', 'error');
}

$stmt = $conexao->prepare('INSERT INTO material (nome) VALUES (?)');
$stmt->bind_param('s', $material);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/materiais.php', 'Material cadastrado com sucesso.');
