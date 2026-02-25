<?php
include 'db.php';
$result = $conn->query("SELECT * FROM pedidos WHERE status='pendente' ORDER BY criado_em");
?>

<h2>Pedidos na fila</h2>

<?php while ($p = $result->fetch_assoc()) { ?>
    <div style="border:1px solid #000; margin:10px; padding:10px;">
        <strong><?= $p['nome_cliente'] ?></strong><br>
        Pedido: <?= $p['pedido'] ?><br>
        Obs: <?= $p['observacoes'] ?><br>

        <a href="concluir.php?id=<?= $p['id'] ?>">Concluir</a>
    </div>
<?php } ?>