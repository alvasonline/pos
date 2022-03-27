<?= $this->extend('front/layout/main'); ?>

<?= $this->section('title') ?>
<?= $titulo; ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    
    <main>
        <div class="container px-4">

            <div class="container mt-5 mb-3 px-4">
                <a name="" id="" class="btn btn-dark" href="<?= base_url('Front/nuevoproducto') ?>" role="button"> <i class="fa-solid fa-circle-plus"></i> Nuevo</a>
                <a name="" id="" class="btn btn-warning" href="<?= base_url('Front/productoseliminadas') ?>" role="button"><i class="fa-solid fa-square-minus"></i> Eliminados</a>
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
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio de Venta</th>
                                <th>Precio de Compra</th>
                                <th>Existencia</th>
                                <th>Stoc Minimo</th>
                                <th>Inventariable</th>
                                <th>Acciones</th>
                                <th>Unidad</th>
                                <th>Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $dato) : ?>
                                <tr>
                                    <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['nombre'] ?></td>
                                    <td><?= $dato['precio_venta'] ?></td>
                                    <td><?= $dato['precio_compra'] ?></td>
                                    <td><?= $dato['existencia'] ?></td>
                                    <td><?= $dato['stock_minimo'] ?></td>
                                    <td><?= $dato['inventariable'] ?></td>
                                    <td>Unidad</td>
                                    <td>Categoria</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url().'/Front/editarproductos/' . $dato['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                            
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-trash"> </i> Eliminar
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                           Está seguro que desea eliminar el producto <strong><?=$dato['nombre']?></strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">No</button>
                                                            <a href="<?= base_url().'/productos/eliminar/'.$dato['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Si</a>
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