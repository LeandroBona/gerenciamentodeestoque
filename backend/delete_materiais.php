<?php
    if(isset($_GET['id'])){
        include 'config.php';
        $id = intval($_GET['id']);

        $sql = "DELETE FROM material WHERE id_material= ?";

        $stmt = $conexao->prepare($sql);

        if($stmt === false){
            header("location:materiais.php?status=erro");

            exit();
        }

        $stmt ->bind_param("i", $id);
        if($stmt ->execute()){
            header("location:materiais.php?status=sucesso");
        }else{
            header("location:materiais.php?status=erro");
        }
        $stmt -> close();
        $conexao ->close();
    }else{
        header("location:materiais.php");
    }
    exit();

?>