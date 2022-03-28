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
                        <div class="col-lg">
                            <div class="card shadow-lg border-0 rounded-lg mt-5  p-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/Front/crearproducto">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus value="<?= old('codigo') ?>" class="form-control" id="codigo" name="codigo" type="text" required />
                                                    <label">Codigo</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.codigo') ?></small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input value="<?= old('nombre') ?>" class="form-control" name="nombre" id="nombre" type="text" required />
                                                    <label>Nombre</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.nombre') ?></small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input value="<?= old('existencia') ?>" class="form-control" name="existencia" id="existencia" type="text" required />
                                                    <label>Existencia</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.existencia') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input value="<?= old('precio_venta') ?>" class="form-control" id="precio_venta" name="precio_venta" type="text" required />
                                                    <label>Precio Venta</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.precio_venta') ?></small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input value="<?= old('precio_compra') ?>" class="form-control" name="precio_compra" id="precio_compra" type="text" required />
                                                    <label>Precio Compra</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.precio_compra') ?></small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input value="<?= old('stock_minimo') ?>" class="form-control" name="stock_minimo" id="stock_minimo" type="text" required />
                                                    <label>Stock Minimo</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.stock_minimo') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-control" name="inventariable" id="inventariable">
                                                        <option value="">Seleccione</option>
                                                        <option value="1">Si</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    <label>Inventariable</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.inventariable') ?></small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-control" name="unidades" id="unidades">
                                                        <option selected value="">Seleccione</option>
                                                        <?php foreach ($unidades as $unidad) { ?>
                                                            <option value="<?= $unidad['id'] ?>"><?= $unidad['nombre'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="unidad_flotante">Unidades</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.unidades') ?></small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-control" id="categorias" name="categorias">
                                                        <option selected value="">Seleccione</option>
                                                        <?php foreach ($categorias as $categoria) { ?>
                                                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="unidad_flotante">Categorias</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.categorias') ?></small>
                                            </div>
                                        </div>
                                        <div class="btn-group d-flex" role="group">
                                            <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Agregar</button>
                                            <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/productos') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($guardado)) {
                                    ?>
                                        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                                            Se ha agregado Satisfactoriamente la Unidad <strong><?php echo $nombre; ?></strong>
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