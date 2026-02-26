<?php
include 'db.php';

/* =========================
   1. Validação de entrada
   ========================= */
if (
    !isset($_POST['nome'], $_POST['produto'], $_POST['quantidade'])
) {
    die("Dados inválidos.");
}

$nome        = trim($_POST['nome']);
$produto     = trim($_POST['produto']);
$quantidade  = (int) $_POST['quantidade'];
$observacoes = $_POST['observacoes'] ?? '';

if ($nome === '' || $produto === '' || $quantidade <= 0) {
    die("Campos obrigatórios inválidos.");
}

/* =========================
   2. Verificar estoque
   ========================= */
$stmt = $conn->prepare(
    "SELECT quantidade_atual FROM estoque WHERE produto = ?"
);
$stmt->bind_param("s", $produto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Produto não cadastrado no estoque.");
}

$estoque = $result->fetch_assoc();

if ($quantidade > $estoque['quantidade_atual']) {
    die("Estoque insuficiente para este produto.");
}

$stmt->close();

/* =========================
   3. Salvar pedido
   ========================= */
$stmt = $conn->prepare(
    "INSERT INTO pedidos (nome_cliente, pedido, observacoes)
     VALUES (?, ?, ?)"
);

$descricaoPedido = $produto . " x" . $quantidade;

$stmt->bind_param(
    "sss",
    $nome,
    $descricaoPedido,
    $observacoes
);

$stmt->execute();
$stmt->close();

/* =========================
   4. Atualizar estoque
   ========================= */
$stmt = $conn->prepare(
    "UPDATE estoque
     SET quantidade_atual = quantidade_atual - ?
     WHERE produto = ?"
);

$stmt->bind_param("is", $quantidade, $produto);
$stmt->execute();
$stmt->close();

/* =========================
   5. Redirecionar
   ========================= */
header("Location: index.php");
exit;