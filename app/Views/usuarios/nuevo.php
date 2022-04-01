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
                                    <form method="POST" action="<?= base_url() ?>/Front/crearusuario">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus class="form-control" value="<?= old('usuario') ?>" id="usuario" name="usuario" type="text" required />
                                                    <label for="inputFirstName">Usuarios</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.usuario') ?></small>
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
                                                    <input value="<?= old('password') ?>" class="form-control" name="password" id="password" type="password" required />
                                                    <label>Contraseña</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.password') ?></small>
                                            </div>
                                        </div>
                                       
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-control" name="rol" id="rol">
                                                        <option selected value="">Seleccione</option>
                                                        <?php foreach ($roles as $rol) { ?>
                                                            <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="unidad_flotante">Rol</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.roles') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-control" name="caja" id="cajas">
                                                        <option selected value="">Seleccione</option>
                                                        <?php foreach ($cajas as $caja) { ?>
                                                            <option value="<?= $caja['id'] ?>"><?= $caja['nombre'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="unidad_flotante">Caja</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.roles') ?></small>
                                            </div>
                                        </div>
                                        <div class="btn-group d-flex" role="group">
                                            <button type="submit" name="" id="" class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Agregar</button>
                                            <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/usuarios') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
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