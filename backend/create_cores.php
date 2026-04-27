<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

$cor = post_string('color');
if ($cor === '') {
    redirect_with_message('/cores.php', 'Informe a cor.', 'error');
}

$stmt = $conexao->prepare('INSERT INTO cor (nome) VALUES (?)');
$stmt->bind_param('s', $cor);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/cores.php', 'Cor cadastrada com sucesso.');
