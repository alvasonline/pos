<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">

    <main>
        <div class="container px-4">
            <div class="card mb-4 mt-5">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <?= $titulo; ?>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Folio</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Ver Recibo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $dato) : ?>
                                <tr>
                                    <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['folio'] ?></td>
                                    <td><?= $dato['total'] ?></td>
                                    <td><?= $dato['fecha_alta'] ?></td>
                                    <td> <a href="<?= base_url() . '/Compras/muestraCompraPdf/' . $dato['id'] ?>" class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i></a> </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endSection(); ?>