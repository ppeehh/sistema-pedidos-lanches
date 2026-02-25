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

        <!-- 🔽 MENU DE NAVEGAÇÃO -->
        <div class="d-flex gap-2 mb-3">
            <a href="index.php" class="btn btn-primary w-100">🏠 Início</a>
            <a href="estoque.php" class="btn btn-warning w-100">📦 Estoque</a>
            <a href="historico.php" class="btn btn-secondary w-100">📄 Histórico</a>
        </div>
        <!-- 🔼 FIM DO MENU -->

        <h4 class="text-center mb-3">Novo Pedido</h4>

        <form action="salvar_pedido.php" method="post">
            <input
                class="form-control mb-2"
                type="text"
                name="nome"
                placeholder="Nome do cliente"
                required
            >

            <textarea
                class="form-control mb-2"
                name="pedido"
                placeholder="Pedido"
                required
            ></textarea>

            <textarea
                class="form-control mb-3"
                name="observacoes"
                placeholder="Observações"
            ></textarea>

            <button class="btn btn-success w-100">
                Enviar Pedido
            </button>
        </form>

    </div>
</div>

</body>
</html>