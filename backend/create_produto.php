<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_message('/create.php', 'Método inválido.', 'error');
}

$nome = post_string('nome');
$descricao = post_string('descricao');
$valorCompra = post_float('valor_compra');
$valorVenda = post_float('valor_venda');
$estado = post_string('estado');
$genero = post_string('genero');
$tamanho = post_string('tamanho');
$idCategoria = post_int('id_categoria');
$idMaterial = post_int('id_material');
$idCor = post_int('id_cor');
$idFornecedor = post_int('id_fornecedor');

if ($nome === '' || $valorCompra <= 0 || $valorVenda <= 0 || $idCategoria <= 0 || $idMaterial <= 0 || $idCor <= 0 || $idFornecedor <= 0) {
    redirect_with_message('/create.php', 'Preencha todos os campos obrigatórios corretamente.', 'error');
}

if ($valorVenda < $valorCompra) {
    redirect_with_message('/create.php', 'Valor de venda não pode ser menor que o valor de compra.', 'error');
}

$imgUrl = null;
if (!empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $pasta = __DIR__ . '/uploads/';
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (!in_array($extensao, $permitidas, true)) {
        redirect_with_message('/create.php', 'Formato de imagem inválido.', 'error');
    }

    $nomeImagem = uniqid('', true) . '.' . $extensao;
    $caminhoCompleto = $pasta . $nomeImagem;
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
        $imgUrl = 'uploads/' . $nomeImagem;
    }
}

$sql = 'INSERT INTO produto (img_url, nome, descricao, valor_compra, valor_venda, estado, genero, tamanho, id_categoria, id_material, id_cor, id_fornecedor)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
$stmt = $conexao->prepare($sql);
$stmt->bind_param('sssddsssiiii', $imgUrl, $nome, $descricao, $valorCompra, $valorVenda, $estado, $genero, $tamanho, $idCategoria, $idMaterial, $idCor, $idFornecedor);
$stmt->execute();
$stmt->close();
$conexao->close();

redirect_with_message('/create.php', 'Produto cadastrado com sucesso.');
