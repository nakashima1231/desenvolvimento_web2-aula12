<?php
require('conexao.php');
session_start();

if(isset($_SESSION['id_usuario']) && $_SESSION['tipo'] == "consumidor") {
    if(isset($_POST['largura'])) {
        $id_consumidor = $_SESSION['id_usuario'];
        $largura = $_POST['largura'];
        $altura = $_POST['altura'];
        $profundidade = $_POST['profundidade'];
        $peso = $_POST['peso'];
        $sensivel = $_POST['sensivel'];

        $comando = "INSERT INTO `entregas` (`id_consumidor`, `largura`, `altura`, `profundidade`, `peso`, `sensivel`, `status`) 
                    VALUES ('$id_consumidor', '$largura', '$altura', '$profundidade', '$peso', '$sensivel', 'disponivel')";
        
        $linhas = $conexao->exec($comando);

        if($linhas > 0) {
            echo "Entrega solicitada com sucesso!";
        } else {
            echo "Erro ao solicitar entrega.";
        }
    } else {
        echo "Preencha o formulário primeiro.";
    }
    ?>
    <br><a href="solicitarEntrega.php">Voltar</a>
    <?php
} else {
    ?>
    <a href="login.php">Fazer login</a>
    <?php
}
?>
