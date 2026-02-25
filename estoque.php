<?php
include 'db.php';

/* Consulta de estoque */
$sql = "SELECT * FROM estoque";
$result = $conn->query($sql);

/* Segurança básica */
if (!$result) {
    die("Erro ao buscar estoque.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque do Evento</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow w-100" style="max-width: 420px;">
        <h4 class="text-center mb-3">Estoque do Evento</h4>

        <!-- ESTOQUE ATUAL -->
        <?php if ($result->num_rows > 0) { ?>
            <div class="mb-3">
                <h6 class="text-muted">Estoque Atual</h6>

                <?php while ($e = $result->fetch_assoc()) { ?>
                    <div class="border rounded p-2 mb-2">
                        <strong><?= htmlspecialchars($e['produto']) ?></strong><br>
                        <span class="text-muted">
                            <?= (int)$e['quantidade_atual'] ?> unidades
                        </span>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="text-muted text-center">
                Nenhum produto cadastrado ainda.
            </p>
        <?php } ?>
        <!-- FIM ESTOQUE -->

        <!-- FORMULÁRIO -->
        <form action="salvar_estoque.php" method="post">
            <input
                class="form-control mb-2"
                type="text"
                name="produto"
                placeholder="Produto (ex: Hot Dog)"
                required
            >

            <input
                class="form-control mb-3"
                type="number"
                name="quantidade"
                min="1"
                placeholder="Quantidade levada"
                required
            >

            <button class="btn btn-primary w-100">
                Salvar Estoque
            </button>
        </form>

        <a href="index.php" class="btn btn-outline-secondary mt-3 w-100">
            Voltar
        </a>
    </div>
</div>

</body>
</html>