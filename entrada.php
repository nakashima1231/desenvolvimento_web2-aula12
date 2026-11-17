<?php
require('conexao.php');

if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = hash('sha256', $_POST['senha']);

    $comandoS = "SELECT `id`, `nome`, `senha`, `tipo` FROM `usuarios` WHERE `email` = '$email'";
    $stm2 = $conexao->prepare($comandoS);
    $stm2->execute();
    $resultado = $stm2->fetch(PDO::FETCH_ASSOC);

    if(isset($resultado['id'])) { 
        if(hash_equals(strtolower($resultado['senha']), $senha)) {
            session_start();
            $_SESSION['id_usuario'] = $resultado['id'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['tipo'] = $resultado['tipo'];

            if($resultado['tipo'] == "consumidor") {
                header("Location: solicitarEntrega.php");
                exit;
            } else if($resultado['tipo'] == "entregador") {
                header("Location: visualizarEntregas.php");
                exit;
            }
        } else {
            echo "Senha incorreta!<br>";
            ?>
            <a href="login.php">Tentar novamente</a>
            <?php
        }
    } else {
        echo "Usuário inexistente!<br>";
        ?>
        <a href="login.php">Fazer login</a>
        <?php
    }
} else {
    header("Location: login.php");
    exit;
}
?>
