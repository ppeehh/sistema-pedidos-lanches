<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Novo Pedido</title>
</head>
<body>

<h2>Novo Pedido</h2>

<form action="salvar_pedido.php" method="post">
    <input type="text" name="nome" placeholder="Nome do cliente" required><br><br>

    <textarea name="pedido" placeholder="Pedido (ex: 1 hot dog + 1 refri)" required></textarea><br><br>

    <textarea name="observacoes" placeholder="Observações (sem milho, sem cebola)"></textarea><br><br>

    <button type="submit">Enviar Pedido</button>
</form>

</body>
</html>