<?php
include 'db.php';

/* Apaga pedidos do evento */
$conn->query("TRUNCATE TABLE pedidos");

/* Apaga estoque do evento */
$conn->query("TRUNCATE TABLE estoque");

/* Volta para o início */
header("Location: index.php");
exit;