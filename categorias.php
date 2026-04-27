<?php
require_once __DIR__ . '/backend/config.php';
require_once __DIR__ . '/includes/layout.php';

$itens = $conexao->query("SELECT id_categoria AS id, nome FROM categoria ORDER BY nome");
render_page_start('Categorias', 'categorias');
?>
<main class="container py-4 page-shell">
  <div class="page-header"><h1 class="h3 mb-1">Categorias</h1><p class="text-muted mb-0">Organize o catálogo por categoria.</p></div>
  <div class="card shadow-sm mt-4 mb-4"><div class="card-body">
    <form action="/backend/create_categorias.php" method="POST" class="row g-2 align-items-end">
      <div class="col-md-10"><label class="form-label">Nome da categoria</label><input type="text" class="form-control" name="categoria" required /></div>
      <div class="col-md-2 d-grid"><button class="btn btn-primary">Cadastrar</button></div>
    </form>
  </div></div>

  <div class="card shadow-sm"><div class="card-body table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead><tr><th>#</th><th>Categoria</th><th class="text-end">Ações</th></tr></thead>
      <tbody>
      <?php while ($row = $itens->fetch_assoc()): ?>
        <tr>
          <td><?= (int) $row['id'] ?></td>
          <td><?= htmlspecialchars($row['nome']) ?></td>
          <td class="text-end">
            <button class="btn btn-warning btn-sm edit-btn" data-id="<?= (int) $row['id'] ?>" data-name="<?= htmlspecialchars($row['nome']) ?>" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
            <a class="btn btn-danger btn-sm" href="/backend/delete_categorias.php?id=<?= (int) $row['id'] ?>" onclick="return confirm('Deseja excluir esta categoria?')">Excluir</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div></div>
</main>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form action="/backend/update-categoria.php" method="POST">
      <div class="modal-header"><h5 class="modal-title">Editar Categoria</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body"><input type="hidden" name="id" id="edit-id"><input class="form-control" name="categoria" id="edit-name" required></div>
      <div class="modal-footer"><button type="submit" class="btn btn-primary">Salvar</button></div>
    </form>
  </div></div>
</div>
<?php
$conexao->close();
render_page_end();
