<?php
include 'db.php';

$nome = $_POST['nome'];
$pedido = $_POST['pedido'];
$obs = $_POST['observacoes'];

$sql = "INSERT INTO pedidos (nome_cliente, pedido, observacoes)
        VALUES ('$nome', '$pedido', '$obs')";

$conn->query($sql);

header("Location: index.php");