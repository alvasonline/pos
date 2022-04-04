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
                        <div class="col-lg-9">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url('/Front/actualizarpassword') ?>">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus disabled class="form-control" value="<?= $datos['usuario'] ?>" id="usuario" name="usuario" type="text" required />
                                                    <label for="inputFirstName">Usuario</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.usuario') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input disabled autofocus class="form-control" value="<?= $datos['nombre'] ?>" id="nombre" name="nombre" type="text" required />
                                                    <label for="inputFirstName">Nombre</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.nombre') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= old('password') ?>" id="password" name="password" type="password" required />
                                                    <label for="inputFirstName">Password</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.password') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= old('rppassword') ?>" id="rppassword" name="rppassword" type="password" required />
                                                    <label for="inputFirstName">Repetir Password</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.rppassword') ?></small>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($mensaje)) {
                                        ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= $mensaje ?>
                                            </div>
                                        <?php } ?>
                                </div>
                            </div>
                            <div class="btn-group d-flex mb-2" role="group">
                                <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-thumbs-up"></i> Actualizar</button>
                                <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('/') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Salir</a>
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
</main>
<?= $this->endSection(); ?>