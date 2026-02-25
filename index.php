<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Pedido</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow w-100" style="max-width: 420px;">
        <h4 class="text-center mb-3">Novo Pedido</h4>

        <form action="salvar_pedido.php" method="post">
            <input class="form-control mb-2" type="text" name="nome" placeholder="Nome do cliente" required>

            <textarea class="form-control mb-2" name="pedido" placeholder="Pedido" required></textarea>

            <textarea class="form-control mb-3" name="observacoes" placeholder="Observações"></textarea>

            <button class="btn btn-success w-100">Enviar Pedido</button>
        </form>

        <a href="historico.php" class="btn btn-outline-secondary mt-3 w-100">
            Histórico de pedidos
        </a>
    </div>
</div>

</body>
</html>