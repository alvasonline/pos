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
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5  p-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Nueva Unidad</h3>
                                </div>
                                <div class="card-body">
                                    <?= $validation->listErrors() ?>

                                    <?= form_open('form') ?>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus class="form-control" id="nombre" name="nombre" type="text" />
                                                    <label for="inputFirstName">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="nombre_corto" id="nombre_corto" type="text" />
                                                    <label for="inputLastName">Nombre Corto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group d-flex" role="group">
                                            <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Agregar</button>
                                            <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/unidades') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($guardado)) {
                                    ?>
                                        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                                            Se ha agregado Satisfactoriamente la Unidad <strong><?php echo $nombre . ' / ' . $nombre_corto; ?></strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php                                    }
                                    ?>

                                    <?php
                                    if (isset($error)) {
                                    ?>
                                        <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
                                            <?php echo $error ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php                                    }
                                    ?>

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