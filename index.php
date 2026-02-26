<?php
include 'db.php';

/* Busca produtos disponíveis no estoque */
$produtos = $conn->query("
    SELECT produto, quantidade_atual 
    FROM estoque 
    WHERE quantidade_atual > 0
    ORDER BY produto ASC
");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Pedido</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow w-100" style="max-width: 520px;">

        <!-- 🔽 MENU -->
        <div class="d-flex gap-2 mb-3">
            <a href="index.php" class="btn btn-primary w-100">🏠 Início</a>
            <a href="estoque.php" class="btn btn-warning w-100">📦 Estoque</a>
            <a href="historico.php" class="btn btn-secondary w-100">📄 Histórico</a>
        </div>

        <!-- 🔽 BOTÃO ENCERRAR EVENTO -->
        <a
            href="encerrar_evento.php"
            class="btn btn-danger w-100 mb-3"
            onclick="return confirm('Tem certeza que deseja encerrar o evento? Isso apagará pedidos e estoque.')"
        >
            🛑 Encerrar Evento
        </a>
        <!-- 🔼 FIM ENCERRAR EVENTO -->

        <h4 class="text-center mb-3">Novo Pedido</h4>

        <form action="salvar_pedido.php" method="post">

            <!-- Nome do cliente -->
            <input
                class="form-control mb-2"
                type="text"
                name="nome"
                placeholder="Nome do cliente"
                required
            >

            <!-- Observações gerais -->
            <textarea
                class="form-control mb-3"
                name="observacoes"
                placeholder="Observações (ex: sem cebola, bem passado, etc)"
            ></textarea>

            <!-- 🔽 PRODUTOS -->
            <div id="produtos-container">

                <div class="d-flex gap-2 mb-2 produto-item">
                    <select name="produtos[]" class="form-select" required>
                        <option value="">Selecione o produto</option>
                        <?php while ($p = $produtos->fetch_assoc()) { ?>
                            <option value="<?= htmlspecialchars($p['produto']) ?>">
                                <?= htmlspecialchars($p['produto']) ?> (<?= $p['quantidade_atual'] ?> disponíveis)
                            </option>
                        <?php } ?>
                    </select>

                    <input
                        type="number"
                        name="quantidades[]"
                        class="form-control"
                        placeholder="Qtd"
                        min="1"
                        required
                    >

                    <button type="button" class="btn btn-danger btn-remove">✖</button>
                </div>

            </div>
            <!-- 🔼 FIM PRODUTOS -->

            <button type="button" class="btn btn-outline-secondary w-100 mb-3" id="add-produto">
                ➕ Adicionar Produto
            </button>

            <button class="btn btn-success w-100">
                Enviar Pedido
            </button>
        </form>

    </div>
</div>

<script>
    const container = document.getElementById('produtos-container');
    const addBtn = document.getElementById('add-produto');

    addBtn.addEventListener('click', () => {
        const first = container.querySelector('.produto-item');
        const clone = first.cloneNode(true);

        clone.querySelector('select').value = '';
        clone.querySelector('input').value = '';

        container.appendChild(clone);
    });

    container.addEventListener('click', e => {
        if (e.target.classList.contains('btn-remove')) {
            const items = container.querySelectorAll('.produto-item');
            if (items.length > 1) {
                e.target.parentElement.remove();
            }
        }
    });
</script>

</body>
</html>