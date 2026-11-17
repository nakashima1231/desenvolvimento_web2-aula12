<?php
require('conexao.php');

// print_r($_POST);
$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];

$senha = hash('sha256', $senha);

$comando = "INSERT INTO `usuarios` (`email`, `nome`, `senha`, `tipo`) VALUES ('$email', '$nome', '$senha', '$tipo')";

$linhas = $conexao->exec($comando);

if($linhas > 0) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro no cadastro.";
}

?>