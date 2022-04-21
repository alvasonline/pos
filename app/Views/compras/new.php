<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8" style="min-width: 500px;">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 p-4">
                                <div class="card-header text-center">
                                    <h3 class="font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="codigo" id="codigo" autofocus>
                                                    <label for="codigo">Código</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="cantidad" id="cantidad">
                                                    <label for="cantidad">Cantidad</label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                        
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="nombre" id="nombre" disabled>
                                                    <label for="nombre">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="precio_compra" id="precio_compra" disabled>
                                                    <label for="precio_comora">Precio de Compra</label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="subtotal" id="subtotal" disabled>
                                                    <label for="subtotal">SubTotal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 mt-4">
                                               <div class="btn btn-secondary" id="agregar_producto" name="agregar_producto">Agregar Producto</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function buscar(numero){
        $.ajax({
            url:'<?php base_url("lstCompras/buscaProducto/") ?>' + numero,
            dataType:'json',
            success:function(resultado){
                
            }
        })
    }
    </script>
    <?= $this->endSection(); ?>