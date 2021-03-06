<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container px-4 mt-5">
        <div class="container mt-5 mb-3 px-4">
                <a name="" id="" class="btn btn-dark" href="<?= base_url('/categorias') ?>" role="button"> <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <?= $titulo; ?>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                         
                                <th>Activar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $dato) : ?>
                                <tr>
                                    <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['nombre'] ?></td>
                                  
                                    <td>
                                        <div class="btn" role="group">
                                          
                                            <!-- Button trigger modal --> 
                                            <a href="#" data-href="<?= base_url() . '/Front/activarcategoria/'. $dato['id'] ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-confirma"><i class="fa-solid fa-circle-check"></i> </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Activar Categoria</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                           Est?? seguro que desea activar la categoria?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">No</button>
                                                            <a class="btn btn-success btn-ok" id="btn-ok"><i class="fa-solid fa-circle-check"></i> Si</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    <?= $this->endSection(); ?>