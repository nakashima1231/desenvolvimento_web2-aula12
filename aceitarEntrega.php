<?php
require('conexao.php');
session_start();

if(isset($_SESSION['id_usuario']) && $_SESSION['tipo'] == "entregador") {
    if(isset($_POST['id_entrega'])) {
        $id_entregador = $_SESSION['id_usuario'];
        $id_entrega = $_POST['id_entrega'];

        $comando = "UPDATE `entregas` 
                    SET `id_entregador` = '$id_entregador', `status` = 'em_rota' 
                    WHERE `id` = '$id_entrega' AND `status` = 'disponivel'";
        $linhas = $conexao->exec($comando);

        if($linhas > 0) {
            echo "Entrega aceita com sucesso! Agora ela está em rota.";
        } else {
            echo "Não foi possível aceitar. Esta entrega já pode ter sido pega por outro entregador.";
        }
    } else {
        echo "Entrega não informada.";
    }
    ?>
    <br><a href="visualizarEntregas.php">Voltar para Entregas Disponíveis</a> | 
    <a href="minhasRotas.php">Ir para Minhas Entregas</a>
    <?php
} else {
    ?>
    <a href="login.php">Fazer login</a>
    <?php
}
?>
