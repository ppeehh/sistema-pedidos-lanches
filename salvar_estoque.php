<?php
include 'db.php';

/* Validação básica */
if (!isset($_POST['produto'], $_POST['quantidade'])) {
    die("Dados inválidos.");
}

$produto = trim($_POST['produto']);
$quantidade = (int) $_POST['quantidade'];

if ($produto === '' || $quantidade <= 0) {
    die("Produto ou quantidade inválidos.");
}

/* Prepared Statement (segurança) */
$stmt = $conn->prepare(
    "INSERT INTO estoque (produto, quantidade_inicial, quantidade_atual)
     VALUES (?, ?, ?)"
);

if (!$stmt) {
    die("Erro ao preparar a query.");
}

$stmt->bind_param("sii", $produto, $quantidade, $quantidade);

if (!$stmt->execute()) {
    die("Erro ao salvar o estoque.");
}

$stmt->close();

/* Redireciona de volta */
header("Location: estoque.php");
exit;