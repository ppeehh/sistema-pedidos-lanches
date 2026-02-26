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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

<div class="container-fluid px-2 px-sm-3 py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card p-3 p-sm-4 shadow w-100">

                <!-- 🔽 MENU -->
                <div class="row g-2 mb-3">
                    <div class="col-12 col-md-4">
                        <a href="index.php" class="btn btn-primary w-100">🏠 Início</a>
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="estoque.php" class="btn btn-warning w-100">📦 Estoque</a>
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="historico.php" class="btn btn-secondary w-100">📄 Histórico</a>
                    </div>
                </div>

                <!-- 🔽 BOTÃO ENCERRAR EVENTO -->
                <a
                    href="encerrar_evento.php"
                    class="btn btn-danger w-100 mb-3"
                    onclick="return confirm('Tem certeza que deseja encerrar o evento? Isso apagará pedidos e estoque.')"
                >
                    🛑 Encerrar Evento
                </a>

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

                        <!-- ITEM -->
                        <div class="row g-2 mb-2 produto-item">

                            <div class="col-12 col-md-7">
                                <select name="produtos[]" class="form-select" required>
                                    <option value="">Selecione o produto</option>
                                    <?php while ($p = $produtos->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($p['produto']) ?>">
                                            <?= htmlspecialchars($p['produto']) ?> (<?= $p['quantidade_atual'] ?> disponíveis)
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-6 col-md-3">
                                <input
                                    type="number"
                                    name="quantidades[]"
                                    class="form-control"
                                    placeholder="Qtd"
                                    min="1"
                                    required
                                >
                            </div>

                            <div class="col-6 col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger w-100 btn-remove">✖</button>
                            </div>

                        </div>
                        <!-- FIM ITEM -->

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
                e.target.closest('.produto-item').remove();
            }
        }
    });
</script>

</body>
</html>