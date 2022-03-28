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
                        <div class="col-lg-9">
                            <div class="card shadow-lg border-0 rounded-lg mt-5  p-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/Front/crearcliente">
                                    <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus class="form-control" value="<?= old('identificacion') ?>" id="identificacion" name="identificacion" type="text" required />
                                                    <label for="inputFirstName">Identificacion</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.identificacion') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input autofocus value="<?= old('nombre') ?>" class="form-control" name="nombre" id="nombre" type="text" required />
                                                    <label>Nombre</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.nombre') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input value="<?= old('direccion') ?>" class="form-control" name="direccion" id="direccion" type="text" required />
                                                    <label>Direccion</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.direccion') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input value="<?= old('telefono') ?>" class="form-control" name="telefono" id="telefono" type="text" required />
                                                    <label>Telefono</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.telefono') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input value="<?= old('correo') ?>" class="form-control" name="correo" id="correo" type="email" required />
                                                    <label>Correo</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.correo') ?></small>
                                            </div>
                                        </div>
                                        <div class="btn-group d-flex" role="group">
                                            <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Agregar</button>
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