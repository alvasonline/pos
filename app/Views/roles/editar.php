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
                                <form method="POST" action="<?= base_url() ?>/Front/actualizarrol">
                                        <input type="text" hidden value="<?= $datos['id'] ?>" name="id" class="form-control">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" autofocus value="<?= $datos['nombre'] ?>" id="nombre" name="nombre" type="text" required />
                                                    <label for="inputFirstName">Folio</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group d-flex" role="group">
                                            <button type="submit" name="" id="" class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Actualizar</button>
                                            <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('/roles') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($guardado)) {
                                    ?>
                                        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                                            Se ha Actulizado Satisfactoriamente la Categoria <strong><?php echo $nombre; ?></strong>
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