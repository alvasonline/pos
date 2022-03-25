<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container px-4">

            <div class="container mt-5 mb-3 px-4">
                <a name="" id="" class="btn btn-dark" href="<?= base_url('Front/nuevacategoria') ?>" role="button"> <i class="fa-solid fa-file-circle-plus"></i> Nuevo</a>
                <a name="" id="" class="btn btn-warning" href="<?= base_url('Front/categoriaseliminadas') ?>" role="button"><i class="fa-solid fa-square-minus"></i> Eliminados</a>
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $dato) : ?>
                                <tr>
                                    <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['nombre'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url().'/Front/editarcategoria/' . $dato['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                            <a href="<?= base_url().'/categorias/eliminar/'.$dato['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</a>
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