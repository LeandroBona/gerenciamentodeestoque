<?php
include'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor_compra = $_POST['valor_compra'];
    $valor_venda = $_POST['valor_venda'];
    $estado = $_POST['estado'];
    $genero = $_POST['genero'];
    $tamanho = $_POST['tamanho'];
    $id_categoria = $_POST['id_categoria'];
    $id_material = $_POST['id_material'];
    $id_cor = $_POST['id_cor'];
    $id_fornecedor = $_POST['id_fornecedor'];

    
    $img_url = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta = "uploads/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $nomeImagem = uniqid() . "_" . basename($_FILES['imagem']['name']);
        $caminhoCompleto = $pasta . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
            $img_url = $caminhoCompleto;
        }
    }

    
    $sql = "INSERT INTO produto (img_url, nome, descricao, valor_compra, valor_venda, estado, genero, tamanho, id_categoria, id_material, id_cor, id_fornecedor)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param(
        "sssddssssiii",
        $img_url,
        $nome,
        $descricao,
        $valor_compra,
        $valor_venda,
        $estado,
        $genero,
        $tamanho,
        $id_categoria,
        $id_material,
        $id_cor,
        $id_fornecedor
    );

    if ($stmt->execute()) {
        echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='create.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conexao->close();
}
?>
