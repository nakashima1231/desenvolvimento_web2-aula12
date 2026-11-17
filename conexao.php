<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "entregas";
$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
?>