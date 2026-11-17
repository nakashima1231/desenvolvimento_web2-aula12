<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário</title>
</head>
<body>
    <!-- $_POST[] -->
    <form action="salva_usuario.php" method='post'>
        <label for="">E-mail:</label>
        <input type="email" name='email'><br>

        <label for="">Nome:</label>
        <input type="text" name='nome'><br>

        <label for="">Senha</label>
        <input type="password"  name='senha'><br>

        <label for="">Tipo</label>
        <select name="tipo">
            <option value="consumidor">Consumidor</option>
            <option value="entregador">Entregador</option>
        </select>

        <input type="submit">
    </form>
</body>
</html>