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
          <form class="d-flex" role="search" action="/backend/create_cores.php" method="POST">
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
      <h2 class="mb-4">Cadastro de Cores</h2>

      <div class="col-md-12">
        <form action="./backend/create_cores.php" method="POST">
          <div class="mb-3">
            <label for="productName" class="form-label"
              >Nome da Cor</label
            >
            <input type="text" class="form-control" id="color" name="color"/>
          </div>
          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
              Cadastrar Cor
            </button>
          </div>
        </form>
      </div>

      <h2 class="mb-3">Cores Cadastradas</h2>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cor</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tbody>


                <?php
                    include './backend/config.php';

                    
                    $sql = "SELECT id_cor, nome from cor";
                    $resultado = $conexao->query($sql);

                    if($resultado->num_rows > 0){
                        
                        while($linha = $resultado->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $linha["id_cor"] . "</td>";
                            echo "<td>" . $linha["nome"] . "</td>";
                            echo "<td> <a href='backend/delete_cor.php?id=" . $linha['id_cor'] . "&table=cor' class='bnt btn-danger' ><i class= 'bi bi-trash3' ></i>excluir</a>";
                            echo "<td>
                            <button 
                                type='button' 
                                class='btn btn-warning btn-sm edit-btn' 
                                data-id='" . $linha['id_cor'] . "' 
                                data-name='" . $linha['nome'] . "' 
                                data-bs-toggle='modal' 
                                data-bs-target='#editModal'>
                                <i class='bi bi-pencil-square'></i> Editar
                            </button>
                        </td>";


                        }
                    }else{
                        echo "<tr><td colspan='4'>Nenhuma cor Cadastrada</td></tr>";
                    }
                    
                    $conexao->close();
                ?>
            </tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>



    </main>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="backend/update_cor.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editar Cor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">

          <div class="mb-3">
            <label class="form-label">Nome da Cor</label>
            <input type="text" class="form-control" name="color" id="edit-name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");
    const inputId = document.getElementById("edit-id");
    const inputName = document.getElementById("edit-name");

    editButtons.forEach(btn => {
      btn.addEventListener("click", function () {
        inputId.value = this.getAttribute("data-id");
        inputName.value = this.getAttribute("data-name");
      });
    });
  });
  </script>


    <div class="mb-5"></div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
