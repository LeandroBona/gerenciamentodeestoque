<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "loja";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha de conexão: " . $conexao->connect_error);
}

$conexao->set_charset('utf8mb4');
