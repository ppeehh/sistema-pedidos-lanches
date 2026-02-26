<?php
include 'db.php';

/*
 ORDEM IMPORTANTE:
 1. itens_pedido (filha)
 2. pedidos (pai)
 3. estoque
*/

$conn->query("DELETE FROM itens_pedido");
$conn->query("DELETE FROM pedidos");
$conn->query("DELETE FROM estoque");

/* (Opcional) resetar IDs */
$conn->query("ALTER TABLE itens_pedido AUTO_INCREMENT = 1");
$conn->query("ALTER TABLE pedidos AUTO_INCREMENT = 1");
$conn->query("ALTER TABLE estoque AUTO_INCREMENT = 1");

/* Volta para início */
header("Location: index.php");
exit;