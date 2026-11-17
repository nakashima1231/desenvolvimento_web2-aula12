<?php
require('conexao.php');
session_start();

if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "consumidor") {
    ?>
    <a href="login.php">Fazer login</a>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Entrega</title>
</head>
<body>
    <h1>Olá, <?php echo $_SESSION['nome']; ?>!</h1>
    <a href="minhasEntregas.php">Acompanhar Minhas Entregas</a> | 
    <a href="sair.php">Sair</a>
    <hr>


    <h2>Solicitar Nova Entrega</h2>
    <form action="salvarEntrega.php" method="post">
        <label for="">Largura (cm):</label>
        <input type="number" step="0.01" name="largura" required><br><br>

        <label for="">Altura (cm):</label>
        <input type="number" step="0.01" name="altura" required><br><br>

        <label for="">Profundidade (cm):</label>
        <input type="number" step="0.01" name="profundidade" required><br><br>

        <label for="">Peso (kg):</label>
        <input type="number" step="0.01" name="peso" required><br><br>

        <label for="">Conteúdo sensível:</label>
        <select name="sensivel" required>
            <option value="nao">Não</option>
            <option value="sim">Sim</option>
        </select><br><br>

        <input type="submit" value="Solicitar Entrega">
    </form>
</body>
</html>
