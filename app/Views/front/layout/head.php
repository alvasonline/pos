<?php $user_session = session(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $this->renderSection('title') ?>&nbsp;- &nbsp;AlvasOnline</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://startbootstrap.github.io/startbootstrap-sb-admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d27d39ec85.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">POS - CDP</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto  me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $user_session->nombre ?>
                        <i class="fas fa-user fa-fw"></i> </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url() . '/Front/cambiapassword/'?>">Datos de usuario</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url() ?>/usuarios/logout">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>

        </nav>
        <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#tienda" aria-expanded="false" aria-controls="tienda">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-basket-shopping"></i></div>
                    Tienda
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="tienda" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('Front/productos') ?>">Productos</a>
                        <a class="nav-link" href="<?= base_url('Front/unidades') ?>">Unidades</a>
                        <a class="nav-link" href="<?= base_url('Front/categorias') ?>">Categorias</a>
                    </nav>
                </div>
                <a href="<?= base_url('Front/clientes') ?>" class="nav-link">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i> </div>
                   Clientes</a>
                   <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#compras" aria-expanded="false" aria-controls="compras">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cash-register"></i></i></div>
                    Tienda
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="compras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('Front/listarcompra') ?>">Compras</a>
                        <a class="nav-link" href="<?= base_url('Compras') ?>">Nueva Compra</a>
                    </nav>
                </div>
                   <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#administracion" aria-expanded="false" aria-controls="administracion">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-toolbox"></i></i></div>
                    Administracion
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="administracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('Front/configuracion') ?>">Configuracion</a>
                        <a class="nav-link" href="<?= base_url('Front/caja') ?>">Caja</a>
                        <a class="nav-link" href="<?= base_url('Front/roles') ?>">Roles</a>
                        <a class="nav-link" href="<?= base_url('Front/usuarios') ?>">Usuarios</a>
                    </nav>
                </div>
                
            </div>
        </div>
    </nav>
</div>