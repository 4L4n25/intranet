<?php

if(!isset($_SESSION)){
  session_start();
}


$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Intranet Art Law & Tax</title>
  <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="/assets/img//apple-touch-icon.png" />
  <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/apple-touch-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon-180x180.png" />
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;0,700;1,500&display=swap" rel="stylesheet">
  <!--Table -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="/assets/css/main.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../index.php">
        <img src="/assets/img/ART_LT_vertical_sin_fondo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Intranet
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-file"></i> Documentos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../../documentos/administracion.php">Administración</a></li>
              <li><a class="dropdown-item" href="../../documentos/contabilidad.php">Contabilidad</a></li>
              <li><a class="dropdown-item" href="../../documentos/fiscal.php">Fiscal</a></li>
              <li><a class="dropdown-item" href="../../documentos/legal.php">Legal</a></li>
              <li><a class="dropdown-item" href="../../documentos/sistemas.php">Sistemas</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../../calendario.php"><i class="fa-solid fa-calendar"></i> Calendario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../../directorio.php"><i class="fa-solid fa-address-book"></i> Directorio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user-clock"></i> Solicitudes
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../../vacaciones.php">Vacaciones</a></li>
              <li><a class="dropdown-item" href="../../viaticos.php">Viaticos</a></li>
              <li><a class="dropdown-item" href="../../cartas.php">Cartas</a></li>
              <li><a class="dropdown-item" href="../../compras.php">Compras</a></li>
            </ul>
          </li>

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-info" type="submit">Buscar</button>
        </form>
      </div>
      <div class="me-5">
        <ul class="navbar-nav me-5 mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php if(intval($rol) == 1 || intval($rol) == 2){ ?>
              <li><a class="dropdown-item" href="../../configuracion.php"><i class="fa-solid fa-gears"></i> configuración</a></li>
              <li>
              <li><a class="dropdown-item" href="../../carga-documentos.php"><i class="fa-solid fa-file-arrow-up"></i> Subir documentos</a></li>
              <li>
              <li><a class="dropdown-item" href="../../includes/calendario/calendario.php"><i class="fa-solid fa-calendar"></i> Agregar evento</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-power-off"></i> Cerrar Sesión</a></li>
              <?php }else{ ?>
                <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-power-off"></i> Cerrar Sesión</a></li>
                <?php }?>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>