<?php
include 'db.php';

$result = $conn->query("SELECT * FROM pedidos WHERE status='concluido' ORDER BY criado_em DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Histórico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">
    <h4 class="mb-3">Histórico de pedidos</h4>

    <?php while ($p = $result->fetch_assoc()) { ?>
        <div class="card mb-2 p-2">
            <strong><?= $p['nome_cliente'] ?></strong><br>
            <?= $p['pedido'] ?><br>
            <small><?= $p['criado_em'] ?></small>
        </div>
    <?php } ?>

    <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
</div>
</body>
</html>