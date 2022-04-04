<?= $this->extend('front/layout/main'); ?>

<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-lg border-0 rounded-lg mt-5  p-4">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Agregar Productos</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url() ?>/Front/crearunidad">
                                        <div class="row">
                                            <div class="col-md-4 mt-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="id_producto" id="id_producto">
                                                    <input class="form-control" id="codigo" name="codigo" type="text" onkeyup="buscarProducto(event, this, this.value)" />
                                                    <label for="inputFirstName">Codigo</label>
                                                </div>
                                                <label for="codigo" id="resultado_error" style="color:red"></label>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-floating">
                                                    <input class="form-control" name="nombre" id="nombre" type="text" disabled />
                                                    <label for="inputLastName">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-floating ">
                                                    <input class="form-control" name="cantidad" id="cantidad" type="number" />
                                                    <label for="inputLastName">Cantidad</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4 mt-3">
                                                <div class="form-floating">
                                                    <input class="form-control" id="precio_compra" name="precio_compra" type="text" disabled />
                                                    <label for="inputFirstName">Precio de compra</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-floating">
                                                    <input class="form-control" name="subtotal" id="subtotal" type="number" disabled />
                                                    <label for="inputLastName">Sub Total</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-4">
                                                <button type="button" class="btn btn-warning" id="agregar_producto" name="agregar_producto"><i class="fa-solid fa-circle-plus"></i> Agregar Producto</button>
                                            </div>
                                        </div>
                                        <table class="table table-dark table-hover table-striped table-sm table-responsive tablaProductos" width='100%'>
                                            <thead>
                                                <th>#</th>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Total</th>
                                                <thead width="1%">
                                                    </th>
                                                </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 offset-md-6">

                                                <label style="font-weight: bold; font-size: 30px; text-align: center" for="">Total $</label>
                                                <input readonly id="total" name="total" value="0.00" size="7" type="text" class="mb-2" style="font-weight: bold; font-size: 30px; text-align:center">
                                            </div>
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
    <script>
       

        function buscarProducto(e, tagCodigo, codigo) {
            var enterKey = 13;

            if (codigo != '') {
                if (e.which == enterKey) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        dataType: 'json',
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {
                                $(tagCodigo).removeClass('has-error');
                                $("#resultado_error").html(resultado.error);
                                if (resultado.existe) {
                                    $("#id_producto").val(resultado.datos.id);
                                    $("#nombre").val(resultado.datos.nombre);
                                    $("#cantidad").val(1);
                                    $("#precio_compra").val(resultado.datos.precio_compra);
                                    $("#subtotal").val(resultado.datos.precio_compra);
                                    $('#cantidad').focus();
                                } else {
                                    $("#id_producto").val('');
                                    $("#id_nombre").val('');
                                    $("#cantidad").val('');
                                    $("#precio_compra").val('');
                                    $("#subtotal").val('');
                                }
                            }
                        }

                    })
                }
            }
        }
    </script>
    <?= $this->endSection(); ?>