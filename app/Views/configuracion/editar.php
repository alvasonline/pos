<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<?php
?>
<div id="layoutSidenav_content">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/Front/actualizarunidad">
                                        <input type="text" hidden value="<?= $datos['id'] ?>" name="id" class="form-control">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" autofocus value="<?= $datos['tienda_rfc'][0] ?>" id="tienda_rfc" name="tienda_rfc" type="text" required />
                                                    <label for="inputFirstName">RUC</label>
                                                </div>
                                            </div>
                                            </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" autofocus value="<?= $datos['tienda_nombre'][0] ?>" id="tienda_nombre" name="tienda_nombre" type="text" required />
                                                    <label for="inputFirstName">Nombre de la Tienda</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" value="<?= $datos['tienda_telefono'] ?>" name="tienda_telefono" id="tienda_telefono" type="text" required />
                                                    <label for="inputLastName">Telefono</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" autofocus value="<?= $datos['tienda_direccion'][0] ?>" id="tienda_direccion" name="tienda_direccion" type="text" required />
                                                    <label for="inputFirstName">Dirección de la Tienda</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" value="<?= $datos['RUC'] ?>" name="tienda_email" id="tienda_ruc" type="text" required />
                                                    <label for="inputLastName">RUC</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group d-flex" role="group">
                                            <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-thumbs-up"></i> Actualizar</button>
                                            <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/unidades') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($guardado)) {
                                    ?>
                                        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                                            Se ha agregado Satisfactoriamente la Categoria <strong><?php echo $nombre; ?></strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </main>
    <?= $this->endSection(); ?>