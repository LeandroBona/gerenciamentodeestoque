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
              <a class="nav-link active" aria-current="page" href="#">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login.php">Login</a>
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
      </header>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <div class="col">
          <div class="card h-100">
            <img
              src="/assets/clothes.jpg"
              class="card-img-top"
              alt="Conjunto Azul"
            />
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Conjunto Azul Casual</h5>
              <p class="card-text">R$ 189,90</p>
              <div class="mt-auto">
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#productDetailModal"
                  data-product-title="Conjunto Azul Casual"
                  data-product-price="R$ 189,90"
                  data-product-img="/assets/clothes.jpg"
                  data-product-desc="Este conjunto casual azul é perfeito para o dia a dia, combinando conforto e estilo. Feito com 100% de algodão."
                >
                  Detalhes
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card h-100">
            <img
              src="/assets/clothes.jpg"
              class="card-img-top"
              alt="Camisa Verde"
            />
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">Camisa Verde Social</h5>
              <p class="card-text">R$ 129,90</p>
              <div class="mt-auto">
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#productDetailModal"
                  data-product-title="Camisa Verde Social"
                  data-product-price="R$ 129,90"
                  data-product-img="/assets/clothes.jpg"
                  data-product-desc="Camisa social de manga longa, ideal para ambientes de trabalho ou eventos formais. Cor verde musgo."
                >
                  Detalhes
                </button>
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
          </div>
        </div>
      </div>
    </div>

    <footer class="bg-dark text-white pt-5 pb-4 mt-auto">
      <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-success">
              Slack Novo
            </h5>
            <p>
              Aqui você pode usar o espaço para falar um pouco sobre a sua
              empresa, seus valores e sua missão.
            </p>
          </div>

          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-success">
              Produtos
            </h5>
            <p>
              <a href="#" class="text-white" style="text-decoration: none"
                >Roupas</a
              >
            </p>
            <p>
              <a href="#" class="text-white" style="text-decoration: none"
                >Calçados</a
              >
            </p>
            <p>
              <a href="#" class="text-white" style="text-decoration: none"
                >Acessórios</a
              >
            </p>
          </div>

          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-success">
              Contato
            </h5>
            <p>
              <i class="bi bi-house-door-fill mr-3"></i> Rua Exemplo, 123,
              Cidade-UF
            </p>
            <p><i class="bi bi-envelope-fill mr-3"></i> contato@slacknovo.com</p>
            <p><i class="bi bi-telephone-fill mr-3"></i> (47) 99999-8888</p>
          </div>
        </div>

        <hr class="mb-4" />

        <div class="row align-items-center">
          <div class="col-md-7 col-lg-8">
            <p>
              &copy; 2025 Todos os direitos reservados:
              <a href="#" style="text-decoration: none">
                <strong class="text-success">slacknovo.com.br</strong>
              </a>
            </p>
          </div>
          <div class="col-md-5 col-lg-4">
            <div class="text-center text-md-right">
              <ul class="list-unstyled list-inline">
                <li class="list-inline-item">
                  <a
                    href="#"
                    class="btn-floating btn-sm text-white"
                    style="font-size: 23px"
                    ><i class="bi bi-instagram"></i
                  ></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <a
      href="https://wa.me/5547999998888?text=Olá!%20Gostaria%20de%20mais%20informações."
      class="whatsapp-float"
      target="_blank"
      role="button"
      aria-label="Fale conosco pelo WhatsApp"
    >
      <i class="bi bi-whatsapp"></i>
    </a>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/scripts.js"></script>
  </body>
</html>
