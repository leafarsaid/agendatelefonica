<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de armazenamento de contatos telefônicos">
    <meta name="author" content="Rafael Dias">

    <title>Agênda telefônica</title>

    <link href="libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="libs/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="./">
        Agenda <span data-feather="phone"></span> telefônica
      </a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Pesquisar" aria-label="Pesquisar">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="" id="linkFav">
            <span data-feather="star"></span>
            Favoritos
          </a>
        </li>
      </ul>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="" id="linkAdd">
            <span data-feather="plus"></span>
            Adicionar
          </a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <!-- navegação lateral -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Todos os contatos <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="star"></span>
                  Favoritos
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Marcadores</span>
            </h6>
            <ul class="nav flex-column mb-0" id="taglist">
            </ul>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Criar marcador" aria-label="Criar marcador" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                  <span data-feather="plus"></span>
                </button>
              </div>
            </div>
          </div>
        </nav>
        <!-- navegação lateral -->

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h4 class="h4">Lista de contatos</h4>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="form-group">
                <select class="form-control" id="combotags">
                
                <option>Favoritos</option>
                </select>
              </div>
            </div>
          </div>
          <div class="table-responsive" id="maincontent">
          </div>
        </main>
      </div>
    </div>

    <script src="libs/jquery/3.2.1/jquery-3.2.1.min.js"></script>
    <script src="libs/js/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/agendatelefonica.js"></script>
    <script src="libs/js/feather.min.js"></script>

  </body>
</html>