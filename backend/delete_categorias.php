<?php
    if(isset($_GET['id'])){
        include 'config.php';
        $id = intval($_GET['id']);

        $sql = "DELETE FROM categoria WHERE id_categoria= ?";

        $stmt = $conexao->prepare($sql);

        if($stmt === false){
            header("location:categorias.php?status=erro");

            exit();
        }

        $stmt ->bind_param("i", $id);
        if($stmt ->execute()){
            header("location:categorias.php?status=sucesso");
        }else{
            header("location:categorias.php?status=erro");
        }
        $stmt -> close();
        $conexao ->close();
    }else{
        header("location:categorias.php");
    }
    exit();

?>