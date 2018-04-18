<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de armazenamento de contatos telefônicos">
    <meta name="author" content="Rafael Dias">

    <title>Agenda telefônica</title>

    <link href="libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="libs/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="./">
        Agenda <span data-feather="phone"></span> telefônica
      </a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Pesquisar" aria-label="Pesquisar" id="pesquisar">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link marcadores favoritos" style="cursor: pointer;" id="linkFav">
            <span data-feather="star"></span>
            Favoritos
          </a>
        </li>
      </ul>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link add-contact" style="cursor: pointer;" id="linkAdd" data-toggle="modal" data-target="#Modal2">
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
                <a class="nav-link marcadores active todos" style="cursor: pointer;">
                  <span data-feather="home"></span>
                  Todos os contatos <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link marcadores favoritos" style="cursor: pointer;">
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
            <form id="addTag">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Criar marcador" aria-label="Criar marcador" aria-describedby="basic-addon2" id="addTagText" required>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                  <span data-feather="plus"></span>
                </button>
              </div>
            </div>
            </form>
          </div>
        </nav>
        <!-- navegação lateral -->

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h4 class="h4">Lista de contatos</h4>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="form-group">
                <select class="form-control" id="combotags">
                </select>
              </div>
            </div>
          </div>
          <div class="table-responsive" id="maincontent">
          </div>
        </main>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary modal-ok">Ok</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal2 -->
    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formAdd">
          <div class="modal-body">
            <div class="form-group">
              <label for="firstname">Nome</label>
              <input type="text" class="form-control" id="firstname" placeholder="Nome do contato" maxlength="100" required>
            </div>
            <div class="form-group">
              <label for="lastname">Sobrenome</label>
              <input type="text" class="form-control" id="lastname" placeholder="Sobrenome do contato" maxlength="100" required>
            </div>
            <div class="form-group">
              <label for="nickname">Apelido</label>
              <input type="text" class="form-control" id="nickname" placeholder="Apelido do contato" maxlength="100" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" placeholder="Ex.: Sr." maxlength="10">
              </div>
              <div class="form-group col-md-3">
                <label for="countrycode">Cód. País</label>
                <input type="text" class="form-control" id="countrycode" placeholder="Ex.: 55" data-mask="000">
              </div>
              <div class="form-group col-md-6">
                <label for="phonenumber">Telefone</label>
                <input type="text" class="form-control" id="phonenumber" placeholder="Telefone com DDD">
              </div>
            </div>
            <div class="form-row">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="chk0" value="0">
                <label class="form-check-label" for="chk0">Favorito</label>
              </div>  
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="chk1" value="1">
                <label class="form-check-label" for="chk1">Família</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="chk19" value="19">
                <label class="form-check-label" for="chk19">Trabalho</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="chk26" value="26">
                <label class="form-check-label" for="chk26">Amigos</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="id-contact-modal">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary modal-ok">Ok</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <script src="libs/jquery/3.2.1/jquery-3.2.1.min.js"></script>
    <script src="libs/js/popper.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/agendatelefonica.js"></script>
    <script src="libs/js/feather.min.js"></script>
    <script src="libs/jquery/plugins/jquery.mask.js"></script>

  </body>
</html>