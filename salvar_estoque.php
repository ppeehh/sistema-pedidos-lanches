<?php
include 'db.php';

$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];

$sql = "INSERT INTO estoque (produto, quantidade_inicial, quantidade_atual)
        VALUES ('$produto', $quantidade, $quantidade)";

$conn->query($sql);

header("Location: estoque.php");