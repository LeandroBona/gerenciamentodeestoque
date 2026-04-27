<?php
require_once __DIR__ . '/backend/config.php';
require_once __DIR__ . '/includes/layout.php';

$busca = trim($_GET['q'] ?? '');
$ordem = $_GET['ordem'] ?? 'recentes';

$orderBy = match ($ordem) {
    'preco_menor' => 'p.valor_venda ASC',
    'preco_maior' => 'p.valor_venda DESC',
    'nome' => 'p.nome ASC',
    default => 'p.id_produto DESC',
};

$sql = "SELECT p.id_produto, p.nome, p.descricao, p.valor_venda, p.tamanho, p.genero, p.estado, p.img_url, c.nome AS categoria
        FROM produto p
        LEFT JOIN categoria c ON c.id_categoria = p.id_categoria";

$params = [];
$types = '';
if ($busca !== '') {
    $sql .= " WHERE p.nome LIKE ? OR p.descricao LIKE ?";
    $like = "%{$busca}%";
    $params = [$like, $like];
    $types = 'ss';
}
$sql .= " ORDER BY {$orderBy}";

$stmt = $conexao->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$produtos = $stmt->get_result();

render_page_start('Catálogo de Produtos', 'catalogo');
?>
<main class="container py-4 page-shell">
  <div class="page-header d-flex flex-wrap gap-3 justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1">Catálogo de produtos</h1>
      <p class="text-muted mb-0">Visual moderno com foco nas regras de negócio e operação diária.</p>
    </div>
    <span class="badge rounded-pill text-bg-success fs-6"><?= (int) $produtos->num_rows ?> itens</span>
  </div>

  <form class="row g-2 mt-3 mb-4" method="GET">
    <div class="col-md-8">
      <input class="form-control" name="q" value="<?= htmlspecialchars($busca) ?>" placeholder="Pesquisar produto por nome ou descrição..." />
    </div>
    <div class="col-md-3">
      <select class="form-select" name="ordem">
        <option value="recentes" <?= $ordem === 'recentes' ? 'selected' : '' ?>>Mais recentes</option>
        <option value="preco_menor" <?= $ordem === 'preco_menor' ? 'selected' : '' ?>>Preço menor</option>
        <option value="preco_maior" <?= $ordem === 'preco_maior' ? 'selected' : '' ?>>Preço maior</option>
        <option value="nome" <?= $ordem === 'nome' ? 'selected' : '' ?>>Nome A-Z</option>
      </select>
    </div>
    <div class="col-md-1 d-grid"><button class="btn btn-outline-success">Filtrar</button></div>
  </form>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <?php if ($produtos->num_rows === 0): ?>
      <div class="col-12"><div class="alert alert-info">Nenhum produto encontrado para os filtros informados.</div></div>
    <?php endif; ?>

    <?php while ($p = $produtos->fetch_assoc()):
      $img = !empty($p['img_url']) ? '/backend/' . ltrim($p['img_url'], '/') : '/assets/clothes.jpg';
    ?>
      <div class="col">
        <div class="card h-100 shadow-sm product-card">
          <img src="<?= htmlspecialchars($img) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>" />
          <div class="card-body d-flex flex-column">
            <small class="text-muted">REF #<?= str_pad((string) $p['id_produto'], 4, '0', STR_PAD_LEFT) ?></small>
            <h5 class="card-title mt-1"><?= htmlspecialchars($p['nome']) ?></h5>
            <p class="card-text mb-2"><strong>R$ <?= number_format((float) $p['valor_venda'], 2, ',', '.') ?></strong></p>
            <p class="small text-muted mb-3"><?= htmlspecialchars($p['categoria'] ?? 'Sem categoria') ?> · <?= htmlspecialchars($p['tamanho']) ?> · <?= htmlspecialchars($p['genero']) ?></p>

            <button type="button" class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#productDetailModal"
              data-product-title="<?= htmlspecialchars($p['nome']) ?>"
              data-product-price="R$ <?= number_format((float) $p['valor_venda'], 2, ',', '.') ?>"
              data-product-img="<?= htmlspecialchars($img) ?>"
              data-product-desc="<?= htmlspecialchars($p['descricao'] ?? 'Sem descrição') ?>">
              Detalhes
            </button>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</main>

<div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6"><img id="modalProductImage" src="" class="img-fluid rounded" alt="Imagem do produto" /></div>
          <div class="col-md-6">
            <h3>Preço: <span id="modalProductPrice"></span></h3>
            <p id="modalProductDescription" class="mt-3"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$stmt->close();
$conexao->close();
render_page_end();
