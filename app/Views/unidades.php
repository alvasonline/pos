<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
<main>
        <div class="container px-4">
            
        <div class="container mt-5 mb-3 px-4">
            <a name="" id="" class="btn btn-dark" href="<?= base_url() ?>" role="button"> <i class="fa-solid fa-file-circle-plus"></i> Nuevo</a>
            <a name="" id="" class="btn btn-warning" href="<?= base_url() ?>" role="button"><i class="fa-solid fa-square-minus"></i> Eliminados</a>
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
                            <th>Nombre Corto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) : ?>
                            <tr>
                                <td><?= $dato['id'] ?></td>
                                <td><?= $dato['nombre'] ?></td>
                                <td><?= $dato['nombre_corto'] ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-square-pen"></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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