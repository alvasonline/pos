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
                                    <form method="POST" action="<?= base_url() ?>/Front/actualizarproducto">
                                        <input type="text" hidden value="<?= $datos['id'] ?>" name="id" class="form-control">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" autofocus value="<?= $datos['codigo'] ?>" id="codigo" name="codigo" type="text" required />
                                                    <label for="inputFirstName">Codigo</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['nombre'] ?>" id="nombre" name="nombre" type="text" required />
                                                    <label for="inputFirstName">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['existencias'] ?>" id="existencia" name="existencia" type="number" required />
                                                    <label for="inputFirstName">Existencia</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['stock_minimo'] ?>" id="stock_minimo" name="stock_minimo" type="number" required />
                                                    <label for="inputFirstName">Stock Minimo</label>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['precio_compra'] ?>" id="precio_compra" name="precio_compra" type="number" required />
                                                    <label for="inputFirstName">Precio Compra</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" value="<?= $datos['precio_venta'] ?>" id="precio_venta" name="precio_venta" type="number" required />
                                                    <label for="inputFirstName">Precio venta</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-control" name="inventariable" id="inventariable">
                                                        <option value="">Seleccione</option>
                                                        <option <?php if ($datos['inventariable'] == 1) {
                                                                    echo "selected";
                                                                } ?> value="1" ?>Si</option>
                                                        <option <?php if ($datos['inventariable'] == 0) {
                                                                    echo "selected";
                                                                } ?> value="0">No</option>
                                                    </select>
                                                    <label>Inventariable</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-control" name="unidades" id="unidades">
                                                        <option selected value="">Seleccione</option>
                                                        <?php foreach ($unidades as $unidad) : ?>
                                                            <option <?php if ($datos['id_unidad'] == $unidad['id']) {
                                                                        echo "selected";
                                                                    } ?> value="<?= $unidad['id'] ?>"><?= $unidad['nombre'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <label for="unidad_flotante">Unidades</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-control" id="categorias" name="categorias">
                                                        <option selected value="">Seleccione</option>
                                                        <?php foreach ($categorias as $categoria) : ?>
                                                            <option <?php if ($datos['id_categoria'] == $categoria['id']) {
                                                                        echo "selected";
                                                                    } ?> value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <label for="unidad_flotante">Categorias</label>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                            <?php
                            if (isset($_GET['guardado']) == 'Si') {?>
                                <div class="alert alert-success" role="alert">
                                    Información guardada satisfactoriamente
                            </div>
                            <?php }; ?>
                            <div class="btn-group d-flex mb-2" role="group">
                                <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-thumbs-up"></i> Actualizar</button>
                                <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/productos') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
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