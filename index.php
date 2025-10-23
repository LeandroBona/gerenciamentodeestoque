<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Catálogo de Produtos</title>
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
    <link rel="stylesheet" href="/assets/css/style.css" />
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
                <li>
                  <a class="dropdown-item" href="/categorias.php"
                    >Categorias</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="/materiais.php">Materiais</a>
                </li>
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

    <main class="container py-4">
      <header class="d-flex justify-content-between align-items-center mb-4">
        <div class="col-12 col-md-4 col-lg-3">
          <select class="form-select" aria-label="Filtro de produtos">
            <option selected>Filtrar por...</option>
            <option value="1">Preço: Menor para Maior</option>
            <option value="2">Preço: Maior para Menor</option>
            <option value="3">Mais Recentes</option>
          </select>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#exportPdfModal"
          >
            Exportar
            <i class="bi bi-filetype-pdf" style="margin-left: 15px"></i>
          </button>
        </div>

        <div
          class="modal fade"
          id="exportPdfModal"
          tabindex="-1"
          aria-labelledby="exportPdfModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exportPdfModalLabel">
                  <i class="bi bi-gear-fill"></i> Configurar Exportação para PDF
                </h1>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <p>
                  Selecione os critérios para gerar o relatório de produtos.
                </p>

                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="exportOptions"
                    id="exportAll"
                    value="all"
                    checked
                  />
                  <label class="form-check-label" for="exportAll">
                    Exportar todos os produtos
                  </label>
                </div>
                <div class="form-check mb-3">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="exportOptions"
                    id="exportFiltered"
                    value="filtered"
                  />
                  <label class="form-check-label" for="exportFiltered">
                    Exportar com filtros específicos
                  </label>
                </div>

                <div id="exportFiltersContainer" style="display: none">
                  <hr />
                  <div class="mb-3">
                    <label for="filterCategory" class="form-label"
                      >Por Categoria:</label
                    >
                    <select class="form-select" id="filterCategory">
                      <option selected>Todas as categorias</option>
                      <option value="1">Camisas</option>
                      <option value="2">Calças</option>
                      <option value="3">Conjuntos</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="filterGender" class="form-label"
                      >Por Gênero:</label
                    >
                    <select class="form-select" id="filterGender">
                      <option selected>Todos os gêneros</option>
                      <option value="1">Masculino</option>
                      <option value="2">Feminino</option>
                      <option value="3">Unissex</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="filterSize" class="form-label"
                      >Por Tamanho:</label
                    >
                    <select class="form-select" id="filterSize">
                      <option selected>Todos os tamanhos</option>
                      <option value="1">PP</option>
                      <option value="2">P</option>
                      <option value="3">M</option>
                      <option value="4">G</option>
                      <option value="5">GG</option>
                    </select>
                  </div>

                  <div class="mt-3">
                    <label for="filterSize" class="form-label"
                      >Ordenar por:</label
                    >
                    <select
                      class="form-select"
                      id="sortOrder"
                      aria-label="Opção de ordenação"
                    >
                      <option value="price_asc" selected>
                        Preço: Menor para o Maior
                      </option>
                      <option value="price_desc">
                        Preço: Maior para o Menor
                      </option>
                      <option value="name_asc">Ordem Alfabética (A-Z)</option>
                      <option value="name_desc">Ordem Alfabética (Z-A)</option>
                      <option value="default">Padrão (Mais Recentes)</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Cancelar
                </button>
                <button type="button" class="btn btn-danger">
                  <i class="bi bi-filetype-pdf"></i> Gerar PDF
                </button>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <div class="col">
          <div class="card h-100">
            <p style="display: flex; justify-content: center">ref #0001</p>
            <img
              src="/assets/clothes.jpg"
              class="card-img-top"
              alt="Conjunto Azul"
            />
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Conjunto Azul Casual</h5>
              <p class="card-text">R$ 189,90</p>

              <div class="mt-auto">
                <a
                  href="#"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#productDetailModal"
                  data-product-title="Conjunto Azul Casual"
                  data-product-price="R$ 189,90"
                  data-product-img="/assets/clothes.jpg"
                  data-product-desc="Este conjunto casual azul é perfeito para o dia a dia, combinando conforto e estilo. Feito com 100% de algodão."
                >
                  Detalhes
                </a>
                <a href="#" class="btn btn-success">Vender</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card h-100">
            <p style="display: flex; justify-content: center">ref #0001</p>
            <img
              src="/assets/clothes.jpg"
              class="card-img-top"
              alt="Conjunto Azul"
            />
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Conjunto Azul Casual</h5>
              <p class="card-text">R$ 189,90</p>

              <div class="mt-auto">
                <a
                  href="#"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#productDetailModal"
                  data-product-title="Conjunto Azul Casual"
                  data-product-price="R$ 189,90"
                  data-product-img="/assets/clothes.jpg"
                  data-product-desc="Este conjunto casual azul é perfeito para o dia a dia, combinando conforto e estilo. Feito com 100% de algodão."
                >
                  Detalhes
                </a>
                <a href="#" class="btn btn-success">Vender</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <div
      class="modal fade"
      id="productDetailModal"
      tabindex="-1"
      aria-labelledby="productDetailModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="productDetailModalLabel"></h1>
            <h6 style="margin-left: 20px; margin-top: 10px">ref #0001</h6>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <img
                  id="modalProductImage"
                  src=""
                  class="img-fluid rounded"
                  alt="Imagem do produto"
                />
              </div>
              <div class="col-md-6">
                <h3>Preço: <span id="modalProductPrice"></span></h3>
                <p id="modalProductDescription" class="mt-3"></p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fechar
            </button>
            <button type="button" class="btn btn-danger">
              <i class="bi bi-trash3"></i> Excluir
            </button>
            <button type="button" class="btn btn-warning">
              <i class="bi bi-pencil-square"></i> Editar
            </button>
            <button type="button" class="btn btn-success">
              <i class="bi bi-cart-plus"></i> Vender
            </button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="supportModal"
      tabindex="-1"
      aria-labelledby="supportModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="supportModalLabel">
              <i class="bi bi-info-circle"></i> Informações de Suporte
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <p>
              Para qualquer dúvida ou problema, entre em contato conosco através
              dos canais abaixo.
            </p>
            <ul class="list-unstyled">
              <li>
                <i class="bi bi-envelope-fill"></i>
                <strong>E-mail:</strong> suporte@dominio.com.br
              </li>
              <li>
                <i class="bi bi-telephone-fill"></i>
                <strong>Telefone:</strong> (47) 99999-8888
              </li>
              <li>
                <i class="bi bi-clock-fill"></i>
                <strong>Horário de Atendimento:</strong> Segunda a Sexta, das
                08:00 às 18:00.
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
            >
              Entendido
            </button>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/scripts.js"></script>
  </body>
</html>
