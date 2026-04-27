<?php
require_once __DIR__ . '/backend/config.php';
require_once __DIR__ . '/includes/layout.php';

$categorias = $conexao->query("SELECT id_categoria, nome FROM categoria ORDER BY nome");
$materiais = $conexao->query("SELECT id_material, nome FROM material ORDER BY nome");
$cores = $conexao->query("SELECT id_cor, nome FROM cor ORDER BY nome");

render_page_start('Cadastro de Produtos', 'cadastro');
?>
<main class="container py-4 page-shell">
  <div class="page-header">
    <h1 class="h3 mb-1">Novo produto</h1>
    <p class="text-muted mb-0">Preencha os dados seguindo as regras de negócio da loja.</p>
  </div>

  <div class="card shadow-sm mt-4">
    <div class="card-body">
      <form action="/backend/create_produto.php" method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Nome do Produto</label>
          <input type="text" name="nome" class="form-control" required />
        </div>
        <div class="col-md-3">
          <label class="form-label">Gênero</label>
          <select class="form-select" name="genero" required>
            <option value="" disabled selected>Selecione...</option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
            <option value="unissex">Unissex</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Tamanho</label>
          <select class="form-select" name="tamanho" required>
            <option value="" disabled selected>Selecione...</option>
            <option value="PP">PP</option><option value="P">P</option><option value="M">M</option>
            <option value="G">G</option><option value="GG">GG</option><option value="G1">G1</option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Descrição</label>
          <textarea class="form-control" name="descricao" rows="3"></textarea>
        </div>

        <div class="col-md-3">
          <label class="form-label">Valor de Compra</label>
          <input type="number" name="valor_compra" min="0" step="0.01" class="form-control" required />
        </div>
        <div class="col-md-3">
          <label class="form-label">Valor de Venda</label>
          <input type="number" name="valor_venda" min="0" step="0.01" class="form-control" required />
        </div>
        <div class="col-md-3">
          <label class="form-label">Fornecedor (ID)</label>
          <input type="number" name="id_fornecedor" min="1" class="form-control" required />
        </div>
        <div class="col-md-3">
          <label class="form-label">Estado</label>
          <select class="form-select" name="estado" required>
            <option value="novo">Novo</option>
            <option value="usado">Usado</option>
            <option value="consignado">Consignado</option>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Categoria</label>
          <select class="form-select" name="id_categoria" required>
            <option value="" disabled selected>Selecione...</option>
            <?php while ($c = $categorias->fetch_assoc()): ?>
              <option value="<?= (int) $c['id_categoria'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Material</label>
          <select class="form-select" name="id_material" required>
            <option value="" disabled selected>Selecione...</option>
            <?php while ($m = $materiais->fetch_assoc()): ?>
              <option value="<?= (int) $m['id_material'] ?>"><?= htmlspecialchars($m['nome']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Cor</label>
          <select class="form-select" name="id_cor" required>
            <option value="" disabled selected>Selecione...</option>
            <?php while ($cor = $cores->fetch_assoc()): ?>
              <option value="<?= (int) $cor['id_cor'] ?>"><?= htmlspecialchars($cor['nome']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Imagem do Produto</label>
          <input class="form-control" type="file" name="imagem" accept="image/*" />
        </div>

        <div class="col-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php
$conexao->close();
render_page_end();
