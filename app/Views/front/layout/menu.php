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
                   <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#administracion" aria-expanded="false" aria-controls="administracion">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-toolbox"></i></i></div>
                    Administracion
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="administracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('Front/configuracion') ?>">Configuracion</a>
                        <a class="nav-link" href="<?= base_url('Front/caja') ?>">Caja</a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>