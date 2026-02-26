<?php
include 'db.php';

// Busca pedidos pendentes
$pedidos = $conn->query("
    SELECT * 
    FROM pedidos 
    WHERE status = 'pendente' 
    ORDER BY criado_em ASC
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Chapa - Pedidos</title>

    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; color: #212529; }
        h2 { text-align:center; margin-bottom:1rem; color: #0d6efd; }
        .card {
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 1rem;
            margin-bottom: 1rem;
            transition: background-color 0.5s;
        }
        .obs-alert { color: #dc3545; font-weight:bold; animation: piscar 1s infinite; }
        @keyframes piscar { 0%, 50%, 100% { background-color: #fff; } 25%, 75% { background-color: #ffe5e5; } }
        .btn { font-size: 1.1rem; padding: 0.6rem; }
    </style>

    <script>
        // Auto-refresh a cada 10s
        setTimeout(() => { location.reload(); }, 10000);

        // Função para tocar som
        function tocarSom() {
            const audio = new Audio('ding.mp3'); // coloque um arquivo ding.mp3 na pasta
            audio.play();
        }

        // Verifica se há pedidos com observações para tocar som
        window.onload = function() {
            const obsElements = document.querySelectorAll('.obs-alert');
            if(obsElements.length > 0) {
                tocarSom();
            }
        }
    </script>
</head>

<body>
<div class="container-fluid p-3">
    <h2>🔥 Pedidos na Chapa</h2>

    <?php if ($pedidos->num_rows === 0) { ?>
        <div class="alert alert-success text-center fs-5">
            Nenhum pedido pendente 🙌
        </div>
    <?php } ?>

    <div class="d-flex flex-wrap justify-content-start">
        <?php while ($p = $pedidos->fetch_assoc()) { ?>

    <?php
    // Busca os itens desse pedido
    $itens = $conn->query("
        SELECT produto, quantidade
        FROM itens_pedido
        WHERE pedido_id = {$p['id']}
    ");
    ?>

    <div class="col-12 col-sm-6 col-md-4">
        <div class="card h-100">

            <h4><?= htmlspecialchars($p['nome_cliente']) ?></h4>

            <ul class="list-group list-group-flush mb-2">
                <?php while ($i = $itens->fetch_assoc()) { ?>
                    <li class="list-group-item">
                        🍔 <?= htmlspecialchars($i['produto']) ?>
                        <strong>x<?= $i['quantidade'] ?></strong>
                    </li>
                <?php } ?>
            </ul>

            <?php if (!empty($p['observacoes'])) { ?>
                <p class="obs-alert">⚠️ <?= htmlspecialchars($p['observacoes']) ?></p>
            <?php } ?>

            <a href="concluir.php?id=<?= $p['id'] ?>" class="btn btn-success w-100 mt-2">
                ✅ Pedido pronto
            </a>

        </div>
    </div>

<?php } ?>
    </div>
</div>
</body>
</html>