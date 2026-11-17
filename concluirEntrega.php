<?php
require('conexao.php');
session_start();

if(isset($_SESSION['id_usuario']) && $_SESSION['tipo'] == "entregador") {
    if(isset($_POST['id_entrega'])) {
        $id_entregador = $_SESSION['id_usuario'];
        $id_entrega = $_POST['id_entrega'];

        $comando = "UPDATE `entregas` 
                    SET `status` = 'entregue' 
                    WHERE `id` = '$id_entrega' AND `id_entregador` = '$id_entregador'";
        $linhas = $conexao->exec($comando);

        if($linhas > 0) {
            echo "Pedido marcado como entregue!";
        } else {
            echo "Erro ao atualizar entrega.";
        }
    } else {
        echo "Entrega não informada.";
    }
    ?>
    <br><a href="minhasRotas.php">Voltar para Minhas Entregas</a>
    <?php
} else {
    ?>
    <a href="login.php">Fazer login</a>
    <?php
}
?>
