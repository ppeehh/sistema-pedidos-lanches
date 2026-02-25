<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("UPDATE pedidos SET status='concluido' WHERE id=$id");

header("Location: chapa.php");