<?php
require('conexao.php');
session_start();

if(!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] != "entregador") {
    ?>
    <a href="login.php">Fazer login</a>
    <?php
    exit;
}

$id_entregador = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Entregas</title>
</head>
<body>
    <h1>Minhas Entregas (Entregador)</h1>
    <a href="visualizarEntregas.php">Ver Entregas Disponíveis</a> | 
    <a href="sair.php">Sair</a>
    <hr>

    <?php
    $comando = "SELECT entregas.*, usuarios.nome AS nome_consumidor 
                FROM `entregas` 
                INNER JOIN `usuarios` ON entregas.id_consumidor = usuarios.id 
                WHERE entregas.id_entregador = '$id_entregador'";
    $stm = $conexao->prepare($comando);
    $stm->execute();
    $entregas = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(count($entregas) > 0) {
        foreach($entregas as $e) {
            ?>
            <div>
                <p><strong>Pedido #<?php echo $e['id']; ?></strong> - Cliente: <?php echo $e['nome_consumidor']; ?></p>
                
                <?php if($e['sensivel'] == "sim") { ?>
                    <p style="color: red; font-weight: bold;">⚠️ CONTEÚDO SENSÍVEL</p>
                <?php } ?>

                <p><strong>Dimensões (L x A x P):</strong> <?php echo $e['largura']; ?>cm x <?php echo $e['altura']; ?>cm x <?php echo $e['profundidade']; ?>cm</p>
                <p><strong>Peso:</strong> <?php echo $e['peso']; ?> kg</p>
                <p><strong>Status atual:</strong> <?php echo $e['status']; ?></p>

                <?php if($e['status'] == "em_rota") { ?>
                    <form action="concluirEntrega.php" method="post">
                        <input type="hidden" name="id_entrega" value="<?php echo $e['id']; ?>">
                        <input type="submit" value="Marcar como Entregue">
                    </form>
                <?php } else { ?>
                    <p><em>✅ Entrega finalizada!</em></p>
                <?php } ?>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "Você ainda não aceitou nenhuma entrega.";
    }
    ?>
</body>
</html>
