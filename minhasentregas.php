<?php
require('conexao.php');
session_start();

if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "consumidor") {
    ?>
    <a href="login.php">Fazer login</a>
    <?php
    exit;
}

$id_consumidor = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Solicitações</title>
</head>
<body>
    <h1>Minhas Solicitações de Entrega</h1>
    <a href="solicitarEntrega.php">Solicitar Nova Entrega</a> | 
    <a href="sair.php">Sair</a>
    <hr>

    <?php
    $comando = "SELECT entregas.*, usuarios.nome AS nome_entregador 
                FROM `entregas` 
                LEFT JOIN `usuarios` ON entregas.id_entregador = usuarios.id 
                WHERE entregas.id_consumidor = '$id_consumidor'";
    $stm = $conexao->prepare($comando);
    $stm->execute();
    $entregas = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(count($entregas) > 0) {
        foreach($entregas as $e) {
            ?>
            <div>
                <p><strong>Pedido #<?php echo $e['id']; ?></strong></p>
                <p><strong>Dimensões (L x A x P):</strong> <?php echo $e['largura']; ?>cm x <?php echo $e['altura']; ?>cm x <?php echo $e['profundidade']; ?>cm</p>
                <p><strong>Peso:</strong> <?php echo $e['peso']; ?> kg</p>
                <p><strong>Conteúdo sensível:</strong> <?php echo $e['sensivel']; ?></p>
                <p><strong>Status atual:</strong> <?php echo $e['status']; ?></p>
                
                <?php if(!empty($e['nome_entregador'])) { ?>
                    <p><strong>Entregador:</strong> <?php echo $e['nome_entregador']; ?></p>
                <?php } else { ?>
                    <p><strong>Entregador:</strong> <em>Aguardando um entregador aceitar...</em></p>
                <?php } ?>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "Você ainda não solicitou nenhuma entrega.";
    }
    ?>
</body>
</html>
