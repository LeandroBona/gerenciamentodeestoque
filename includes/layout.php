<?php
function render_page_start(string $title, string $active = ''): void
{
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title><?= htmlspecialchars($title) ?></title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
      <link rel="stylesheet" href="/assets/css/style.css" />
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">
          <img src="/assets/img/logo.svg" alt="Logo" width="100" height="90" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link <?= $active === 'catalogo' ? 'active' : '' ?>" href="/index.php">Catálogo</a></li>
            <li class="nav-item"><a class="nav-link <?= $active === 'cadastro' ? 'active' : '' ?>" href="/create.php">Cadastro de Produtos</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle <?= in_array($active, ['categorias','materiais','cores'], true) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Cadastros</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/categorias.php">Categorias</a></li>
                <li><a class="dropdown-item" href="/materiais.php">Materiais</a></li>
                <li><a class="dropdown-item" href="/cores.php">Cores</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link <?= $active === 'caixa' ? 'active' : '' ?>" href="/caixa.php">Caixa</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
}

function render_page_end(array $scripts = []): void
{
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <?php foreach ($scripts as $script): ?>
      <script src="<?= htmlspecialchars($script) ?>"></script>
    <?php endforeach; ?>
    </body>
    </html>
    <?php
}
