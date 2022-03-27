<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-basket-shopping"></i></div>
                    Productos
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('/') ?>">Productos</a>
                        <a class="nav-link" href="<?= base_url('Front/unidades') ?>">Unidades</a>
                        <a class="nav-link" href="<?= base_url('Front/categorias') ?>">Categorias</a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>