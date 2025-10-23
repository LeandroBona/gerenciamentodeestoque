<?php
// Configuração do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "loja";

// Conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificação de conexão
if($conexao->connect_error){
    die("Falha de conexão" . $conexao->connect_error);
}


?>