<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Catálogo de Produtos</title>
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
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body class="text-center">
    
      <main class="container py-4 d-flex justify-content-center">

        <div class="card " style="width: 50%;">
            <div class="card-header">
                <div class="container text-center p-3">
                    <h2>Cadastrar usuario</h2>
                </div>
            </div>
            <div class="card-body">
                <form action="backend/register.php" method="POST">
                    <br>
                    <div class="row">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Usuario</span>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="nome" id="nome">
                        </div>
                        
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Telefone</span>
                                <input type="text" class="form-control" aria-label="telefone" aria-describedby="basic-addon1" name="telefone" id="telefone" >
                            </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="col btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Usuario ou Senha incorretos">
                            Avançar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
