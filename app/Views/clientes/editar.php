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
                                    <form method="POST" action="<?= base_url() ?>/Front/actualizarcliente">
                                        <input type="text" hidden value="<?= $datos['id'] ?>" name="id" class="form-control">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['nombre'] ?>" id="nombre" name="nombre" type="text" required />
                                                    <label for="inputFirstName">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" autofocus value="<?= $datos['direccion'] ?>" id="direccion" name="direccion" type="text" required />
                                                    <label for="inputFirstName">Direccion</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['telefono'] ?>" id="telefono" name="telefono" type="number" required />
                                                    <label for="inputFirstName">Telefono</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['correo'] ?>" id="correo" name="correo" type="email" required />
                                                    <label for="inputFirstName">Correo</label>
                                                </div>
                                            </div>
                                        </div>


                                </div>
                            </div>
                            <div class="btn-group d-flex mb-2" role="group">
                                <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-thumbs-up"></i> Actualizar</button>
                                <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/clientes') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
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