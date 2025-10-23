<?php
require_once "backend/config.php";

// ======= bosta de valoressss =======

// Total das vendas
$sql_vendas = "SELECT SUM(valor_venda_total) AS total_vendas FROM venda";
$res_vendas = $conexao->query($sql_vendas);
$total_vendas = $res_vendas->fetch_assoc()['total_vendas'] ?? 0;

// Total de custo 
$sql_custos = "SELECT SUM(valor_compra_total) AS total_custo FROM venda";
$res_custos = $conexao->query($sql_custos);
$total_custo = $res_custos->fetch_assoc()['total_custo'] ?? 0;

// Lucro total
$total_lucro = $total_vendas - $total_custo;

// Total de saídas de caixa
$sql_saidas = "SELECT SUM(valor) AS total_saidas FROM saidacaixa";
$res_saidas = $conexao->query($sql_saidas);
$total_saidas = $res_saidas->fetch_assoc()['total_saidas'] ?? 0;

// Valor em caixa pinto
$valor_caixa = $total_vendas - $total_saidas;

// Histórico de vendas
$sql_hist = "
  SELECT v.*, p.nome AS produto
  FROM venda v
  JOIN produto p ON v.id_produto = p.id_produto
  ORDER BY v.data_hora DESC
";
$res_hist = $conexao->query($sql_hist);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Caixa do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="assets/img/logo.svg" alt="Logo" width="100" height="90" />
        </a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="/index.php">Catálogo</a></li>
            <li class="nav-item"><a class="nav-link" href="/create.php">Cadastro de Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="/caixa.php">Caixa</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="container py-4">
      <h1 class="mb-4">Caixa do Sistema</h1>

      <div class="row g-4 mb-5">
        <div class="col-md-7 col-lg-8">
          <div class="card text-bg-success h-100">
            <div class="card-body text-center">
              <h5 class="card-title">VALOR TOTAL DAS VENDAS</h5>
              <p class="card-text display-6 fw-bold">R$ <?= number_format($total_vendas, 2, ',', '.') ?></p>

              <h5 class="card-title mt-4">VALOR TOTAL DE LUCRO</h5>
              <p class="card-text display-6 fw-bold">R$ <?= number_format($total_lucro, 2, ',', '.') ?></p>

              <h5 class="card-title mt-4">VALOR EM CAIXA</h5>
              <p class="card-text display-6 fw-bold">R$ <?= number_format($valor_caixa, 2, ',', '.') ?></p>

              <h5 class="card-title mt-4">SAÍDAS DE CAIXA</h5>
              <p class="card-text display-6 fw-bold">R$ <?= number_format($total_saidas, 2, ',', '.') ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-5 col-lg-4">
          <div class="card h-100">
            <div class="card-header fw-bold">Registrar Saída de Caixa</div>
            <div class="card-body">
              <form method="POST" action="backend/registrar_saida.php">
                <div class="mb-3">
                  <label for="saidaValor" class="form-label">Valor</label>
                  <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="number" step="0.01" class="form-control" id="saidaValor" name="valor" placeholder="0,00" required />
                  </div>
                </div>
                <div class="mb-3">
                  <label for="saidaMotivo" class="form-label">Motivo</label>
                  <input type="text" class="form-control" id="saidaMotivo" name="motivo" placeholder="Ex: Pagamento de fornecedor" required />
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-warning"><i class="bi bi-box-arrow-up"></i> Registrar Saída</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <h2 class="mb-3">Histórico de Vendas</h2>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Produto</th>
                  <th>Valor Custo</th>
                  <th>Valor Venda</th>
                  <th>Lucro</th>
                  <th>Data/Hora</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($res_hist->num_rows > 0):
                  $i = 1;
                  while ($row = $res_hist->fetch_assoc()):
                    $lucro = $row['valor_venda_total'] - $row['valor_compra_total'];
                ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= htmlspecialchars($row['produto']) ?></td>
                      <td>R$ <?= number_format($row['valor_compra_total'], 2, ',', '.') ?></td>
                      <td>R$ <?= number_format($row['valor_venda_total'], 2, ',', '.') ?></td>
                      <td>R$ <?= number_format($lucro, 2, ',', '.') ?></td>
                      <td><?= date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?></td>
                    </tr>
                <?php
                  endwhile;
                else:
                  echo "<tr><td colspan='6' class='text-center'>Nenhuma venda registrada.</td></tr>";
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
