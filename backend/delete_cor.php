<?php
    if(isset($_GET['id'])){
        include 'config.php';
        $id = intval($_GET['id']);

        $sql = "DELETE FROM cor WHERE id_cor= ?";

        $stmt = $conexao->prepare($sql);

        if($stmt === false){
            header("location:cores.php?status=erro");

            exit();
        }

        $stmt ->bind_param("i", $id);
        if($stmt ->execute()){
            header("location:cores.php?status=sucesso");
        }else{
            header("location:cores.php?status=erro");
        }
        $stmt -> close();
        $conexao ->close();
    }else{
        header("location:cores.php");
    }
    exit();

?>