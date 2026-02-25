<?php
$conn = new mysqli("localhost", "root", "", "pedidos_lanches");

if ($conn->connect_error) {
    die("Erro na conexão");
}
?>