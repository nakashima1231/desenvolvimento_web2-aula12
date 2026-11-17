<?php
require('conexao.php');
session_start();

if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "entregador") {
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
    <title>Entregas Disponíveis</title>
</head>
<body>
    <h1>Olá, <?php echo $_SESSION['nome']; ?>!</h1>
    <a href="minhasRotas.php">Minhas Entregas</a> | 
    <a href="sair.php">Sair</a>
    <hr>


    <h2>Entregas Disponíveis</h2>

    <?php
    $comando = "SELECT entregas.*, usuarios.nome AS nome_consumidor 
                FROM `entregas` 
                INNER JOIN `usuarios` ON entregas.id_consumidor = usuarios.id 
                WHERE entregas.status = 'disponivel'";
    $stm = $conexao->prepare($comando);
    $stm->execute();
    $entregas = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(count($entregas) > 0) {
        foreach($entregas as $e) {
            ?>
            <div>
                <p><strong>Pedido #<?php echo $e['id']; ?></strong> - Solicitado por: <?php echo $e['nome_consumidor']; ?></p>
                
                <?php 
                if($e['sensivel'] == "sim") { 
                    ?>
                    <p style="color: red; font-weight: bold; background-color: #ffe6e6; padding: 5px; border: 1px solid red; display: inline-block;">
                        ⚠️ ATENÇÃO: CONTEÚDO SENSÍVEL / FRÁGIL!
                    </p>
                    <?php 
                } 
                ?>

                <p><strong>Dimensões (L x A x P):</strong> <?php echo $e['largura']; ?>cm x <?php echo $e['altura']; ?>cm x <?php echo $e['profundidade']; ?>cm</p>
                <p><strong>Peso:</strong> <?php echo $e['peso']; ?> kg</p>
                <p><strong>Status:</strong> <?php echo $e['status']; ?></p>

                <form action="aceitarEntrega.php" method="post">
                    <input type="hidden" name="id_entrega" value="<?php echo $e['id']; ?>">
                    <input type="submit" value="Aceitar Entrega">
                </form>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "Nenhuma entrega disponível no momento.";
    }
    ?>
</body>
</html>
