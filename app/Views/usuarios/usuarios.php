<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container px-4">
            <div class="container mt-5 mb-3 px-4">
                <a name="" id="" class="btn btn-dark" href="<?= base_url('Front/nuevousuario') ?>" role="button"> <i class="fa-solid fa-circle-plus"></i> Nuevo</a>
                <a name="" id="" class="btn btn-warning" href="<?= base_url('Front/usuarioseliminados') ?>" role="button"><i class="fa-solid fa-square-minus"></i> Eliminados</a>
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
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $dato) { ?>
                                <tr>
                                <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['nombre'] ?></td>
                                    <td><?= $dato['usuario'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="<?= base_url().'/Front/editarusuario'?>" method="POST">
                                            <input type="text" hidden value="<?= $dato['id'] ?>" name="id" class="form-control">
                                            <button class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </form>                                        
                                      
                                            <a href="#" data-href="<?= base_url() .'/Front/eliminarusuario/' . $dato['id'] ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma"><i class="fa-solid fa-trash"> </i></a>
                                        </div>
                                        <!-- Ventana Modal -->
                                        <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro que desea eliminar el Usuario?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="fa-solid fa-angle-left"></i> No</button>
                                                            <a class="btn btn-danger btn-ok" id="btn-ok"> <i class="fa-solid fa-trash"> </i> Si</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Termina Modal -->
                                        </div>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    <?= $this->endSection(); ?>