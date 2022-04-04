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
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 p-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/Front/actualizarconfiguracion">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus class="form-control" id="tienda_nombre" name="tienda_nombre" type="text" value="<?= $tienda_nombre ?>" required />
                                                    <label>Nombre de la Tienda</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.tienda_nombre') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="tienda_rfc" name="tienda_rfc" type="text" value="<?= $tienda_rfc ?>" required />
                                                    <label>RUC</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.tienda_rfc') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="tienda_telefono" name="tienda_telefono" type="number" value="<?= $tienda_telefono ?>" required />
                                                    <label>Telefono</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.tienda_telefono') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="tienda_email" name="tienda_email" type="email" value="<?= $tienda_email ?>" required />
                                                    <label>Correo</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.tienda_email') ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <textarea rows="3" class="form-control" id="tienda_direccion" name="tienda_direccion" required><?= $tienda_direccion ?></textarea>
                                                    <label>Direccion de la tienda</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.tienda_direccion') ?></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <textarea rows="3" class="form-control" id="ticket_leyenda" name="ticket_leyenda"><?= $ticket_leyenda ?></textarea>
                                                    <label>Leyenda Ticket</label>
                                                </div>
                                                <small class="text-danger"> <?= session('errors.ticket_leyenda') ?></small>
                                            </div>
                                        </div>
                                        <div class="btn" role="button">
                                            <button type="submit" name="" id="" class="btn btn-success"><i class="fa-solid fa-circle-check"></i> Guardar</button>

                                        </div>
                                    </form>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>
    </main>
    <?= $this->endSection(); ?>