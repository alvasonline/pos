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
                            <div class="card shadow-lg border-0 rounded-lg mt-5 p-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/Front/crearcategoria">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input autofocus class="form-control" id="nombre" name="nombre" type="text" required />
                                                    <label for="inputFirstName">Nombre</label>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>
                                        <div class="btn-group mb-4" role="group">
                                            <button type="submit" name="" id="" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Agregar</button>
                                            <a type="button" name="regresar" id="regresar" class="btn btn-warning" href="<?= base_url('Front/categorias') ?>" role="button"><i class="fa-solid fa-circle-chevron-left"></i> Regresar</a>
                                        </div>
                                    </form>
                                    <?php
                                    if(isset($guardado)){
                                        ?>
                                        <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                                            Se ha agregado Satisfactoriamente la Categoria <strong><?php echo $nombre;?></strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
                                        </div>
                                        <?php                                    }
                                    ?>
                                    <?php
                                    if (isset($error)) {
                                    ?>
                                        <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
                                       <?php echo $error?>
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