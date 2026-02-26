<?php
include 'db.php';

/* 1️⃣ Validação básica */
if (
    !isset($_POST['nome'], $_POST['produtos'], $_POST['quantidades'])
) {
    die("Dados inválidos");
}

$nome        = trim($_POST['nome']);
$observacoes = trim($_POST['observacoes'] ?? '');
$produtos    = $_POST['produtos'];
$quantidades = $_POST['quantidades'];

if ($nome === '' || count($produtos) === 0) {
    die("Dados inválidos");
}

/* 2️⃣ Cria pedido */
$stmt = $conn->prepare(
    "INSERT INTO pedidos (nome_cliente, observacoes, status)
     VALUES (?, ?, 'pendente')"
);
$stmt->bind_param("ss", $nome, $observacoes);
$stmt->execute();

$pedido_id = $conn->insert_id;
$stmt->close();

/* 3️⃣ Processa cada produto */
for ($i = 0; $i < count($produtos); $i++) {

    $produto    = trim($produtos[$i]);
    $quantidade = (int) $quantidades[$i];

    if ($produto === '' || $quantidade <= 0) {
        continue;
    }

    /* Verifica estoque */
    $stmt = $conn->prepare(
        "SELECT quantidade_atual FROM estoque WHERE produto = ?"
    );
    $stmt->bind_param("s", $produto);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        die("Produto não cadastrado no estoque.");
    }

    $estoque = $res->fetch_assoc();

    if ($estoque['quantidade_atual'] < $quantidade) {
        die("Estoque insuficiente para $produto.");
    }

    $stmt->close();

    /* Insere item do pedido */
    $stmt = $conn->prepare(
        "INSERT INTO itens_pedido (pedido_id, produto, quantidade)
         VALUES (?, ?, ?)"
    );
    $stmt->bind_param("isi", $pedido_id, $produto, $quantidade);
    $stmt->execute();
    $stmt->close();

    /* Atualiza estoque */
    $stmt = $conn->prepare(
        "UPDATE estoque
         SET quantidade_atual = quantidade_atual - ?
         WHERE produto = ?"
    );
    $stmt->bind_param("is", $quantidade, $produto);
    $stmt->execute();
    $stmt->close();
}

/* 4️⃣ Volta */
header("Location: index.php");
exit;