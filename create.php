<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Produtos</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="assets/img/logo.svg" alt="Logo" width="100" height="90" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/index.php"
                >Catálogo</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/create.php">Cadastro de Produtos</a>
            </li>
            <div class="dropdown">
              <button
                class="btn dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
              >
                Editar
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/categorias.php">Categorias</a></li>
                <li><a class="dropdown-item" href="/materiais.php">Materiais</a></li>
                <li><a class="dropdown-item" href="/cores.php">Cores</a></li>
              </ul>
            </div>
            <li class="nav-item">
              <a class="nav-link" href="/caixa.php">Caixa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sair</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="#"
                data-bs-toggle="modal"
                data-bs-target="#supportModal"
                ><i class="bi bi-info-circle"></i> Suporte</a
              >
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Pesquisar produto..."
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Buscar
            </button>
          </form>
        </div>
      </div>
    </nav>

    <main class="container mt-4">
      <h2 class="mb-4">Cadastro de Produto</h2>

      

        <div class="col-md-8">
          <form action="backend/create_produto.php" method="POST" enctype="multipart/form-data">

            
          <div class="mb-3">
            <label for="productName" class="form-label">Nome do Produto</label>
            <input type="text" name="nome" class="form-control" id="productName" required />
          </div>

          <div class="mb-3">
            <label for="productDescription" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="productDescription" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="productPrice" class="form-label">Valor de Compra</label>
            <div class="input-group">
              <span class="input-group-text">R$</span>
              <input type="number" name="valor_compra" step="0.01" class="form-control" required />
            </div>
          </div>

          <div class="mb-3">
            <label for="productPrice" class="form-label">Valor de Venda</label>
            <div class="input-group">
              <span class="input-group-text">R$</span>
              <input type="number" name="valor_venda" step="0.01" class="form-control" required />
            </div>
          </div>

         <div class="row mb-3"> 
          <div class="col-md-4">
            <label for="categorySelect" class="form-label">Categoria</label>
            <select class="form-select" name="id_categoria" required>
              <option selected disabled>Selecione...</option>
              <?php
                include './backend/config.php'; 

                $sql = "SELECT id_categoria, nome FROM categoria ORDER BY nome ASC";
                $resultado = $conexao->query($sql);

                if ($resultado && $resultado->num_rows > 0) {
                  while ($linha = $resultado->fetch_assoc()) {
                    echo "<option value='" . $linha['id_categoria'] . "'>" . htmlspecialchars($linha['nome']) . "</option>";
                  }
                } else {
                  echo "<option disabled>Nenhuma categoria cadastrada</option>";
                }

                $conexao->close();
              ?>
            </select>
          </div>
         </div>

            <div class="col-md-4">
              <label for="genderSelect" class="form-label">Gênero</label>
              <select class="form-select" name="genero" required>
                <option selected disabled>Selecione...</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="unissex">Unissex</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="sizeSelect" class="form-label">Tamanho</label>
              <select class="form-select" name="tamanho" required>
                <option selected disabled>Selecione...</option>
                <option value="PP">PP</option>
                <option value="P">P</option>
                <option value="M">M</option>
                <option value="G">G</option>
                <option value="GG">GG</option>
                <option value="G1">G1</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Estado do Produto</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="estado" value="novo" />
              <label class="form-check-label">Novo</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="estado" value="usado" checked />
              <label class="form-check-label">Usado</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="estado" value="consignado" />
              <label class="form-check-label">Consignado</label>
            </div>
          </div>

         <div class="row mb-3"> 
            <div class="col-md-4">
              <label for="categorySelect" class="form-label">Materiais</label>
              <select class="form-select" name="id_material" required>
                <option selected disabled>Selecione...</option>
                <?php
                  include './backend/config.php';

                  $sql = "SELECT id_material, nome FROM material ORDER BY nome ASC";
                  $resultado = $conexao->query($sql);

                  if ($resultado && $resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                      echo "<option value='" . $linha['id_material'] . "'>" . htmlspecialchars($linha['nome']) . "</option>";
                    }
                  } else {
                    echo "<option disabled>Nenhuma categoria cadastrada</option>";
                  }

                  $conexao->close();
                ?>
              </select>
            </div>
          </div>


            
              <div class="row mb-3"> 
            <div class="col-md-4">
              <label for="categorySelect" class="form-label">Cor</label>
              <select class="form-select" name="id_cor" required>
                <option selected disabled>Selecione...</option>
                <?php
                  include './backend/config.php';

                  $sql = "SELECT id_cor, nome FROM cor ORDER BY nome ASC";
                  $resultado = $conexao->query($sql);

                  if ($resultado && $resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                      echo "<option value='" . $linha['id_cor'] . "'>" . htmlspecialchars($linha['nome']) . "</option>";
                    }
                  } else {
                    echo "<option disabled>Nenhuma categoria cadastrada</option>";
                  }

                  $conexao->close();
                ?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="supplierName" class="form-label">Fornecedor (ID)</label>
            <input type="number" name="id_fornecedor" class="form-control" required />
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Imagem do Produto</label>
            <input class="form-control" type="file" name="imagem" accept="image/*" />
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
          </div>
        </form>

        </div>
      </div>
    </main>

    <div class="mb-5"></div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
