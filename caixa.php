<?php
require_once __DIR__ . '/backend/config.php';
require_once __DIR__ . '/includes/layout.php';

$sqlVendas = "SELECT COALESCE(SUM(valor_venda_total), 0) AS total_vendas, COALESCE(SUM(valor_compra_total), 0) AS total_custo FROM venda";
$totais = $conexao->query($sqlVendas)->fetch_assoc();
$totalVendas = (float) $totais['total_vendas'];
$totalCusto = (float) $totais['total_custo'];
$totalLucro = $totalVendas - $totalCusto;

$sqlSaidas = "SELECT COALESCE(SUM(valor), 0) AS total_saidas FROM saidacaixa";
$totalSaidas = (float) $conexao->query($sqlSaidas)->fetch_assoc()['total_saidas'];
$valorCaixa = $totalVendas - $totalSaidas;

$historico = $conexao->query("SELECT v.*, p.nome AS produto FROM venda v JOIN produto p ON p.id_produto = v.id_produto ORDER BY v.data_hora DESC");

render_page_start('Caixa', 'caixa');
?>
<main class="container py-4 page-shell">
  <div class="page-header mb-4"><h1 class="h3 mb-1">Painel de Caixa</h1><p class="text-muted mb-0">Controle financeiro consolidado de vendas, lucro e saídas.</p></div>

  <div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card text-bg-success h-100"><div class="card-body"><small>Vendas</small><h4>R$ <?= number_format($totalVendas, 2, ',', '.') ?></h4></div></div></div>
    <div class="col-md-3"><div class="card text-bg-dark h-100"><div class="card-body"><small>Custo</small><h4>R$ <?= number_format($totalCusto, 2, ',', '.') ?></h4></div></div></div>
    <div class="col-md-3"><div class="card text-bg-primary h-100"><div class="card-body"><small>Lucro</small><h4>R$ <?= number_format($totalLucro, 2, ',', '.') ?></h4></div></div></div>
    <div class="col-md-3"><div class="card text-bg-warning h-100"><div class="card-body"><small>Caixa disponível</small><h4>R$ <?= number_format($valorCaixa, 2, ',', '.') ?></h4></div></div></div>
  </div>

  <div class="card shadow-sm mb-4"><div class="card-body">
    <h2 class="h5 mb-3">Registrar saída de caixa</h2>
    <form method="POST" action="/backend/registrar_saida.php" class="row g-2 align-items-end">
      <div class="col-md-3"><label class="form-label">Valor</label><input type="number" name="valor" step="0.01" min="0.01" class="form-control" required /></div>
      <div class="col-md-7"><label class="form-label">Motivo</label><input type="text" name="motivo" class="form-control" required /></div>
      <div class="col-md-2 d-grid"><button class="btn btn-warning">Registrar</button></div>
    </form>
  </div></div>

  <div class="card shadow-sm"><div class="card-body table-responsive">
    <table class="table table-striped align-middle mb-0">
      <thead><tr><th>#</th><th>Produto</th><th>Custo</th><th>Venda</th><th>Lucro</th><th>Data</th></tr></thead>
      <tbody>
      <?php if ($historico->num_rows === 0): ?>
        <tr><td colspan="6" class="text-center">Nenhuma venda registrada.</td></tr>
      <?php endif; ?>
      <?php $i = 1; while ($row = $historico->fetch_assoc()): $lucro = $row['valor_venda_total'] - $row['valor_compra_total']; ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['produto']) ?></td>
          <td>R$ <?= number_format((float) $row['valor_compra_total'], 2, ',', '.') ?></td>
          <td>R$ <?= number_format((float) $row['valor_venda_total'], 2, ',', '.') ?></td>
          <td>R$ <?= number_format((float) $lucro, 2, ',', '.') ?></td>
          <td><?= date('d/m/Y H:i', strtotime($row['data_hora'])) ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div></div>
</main>
<?php
$conexao->close();
render_page_end();
