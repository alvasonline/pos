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
                        <div class="col-lg-8" style="min-width: 500px;">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 p-4">
                                <div class="card-header text-center">
                                    <h3 class="font-weight-light my-4"><?= $titulo; ?></h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="codigo" id="codigo" autofocus onkeyup="buscar(event,this,this.value)">
                                                    <label for="codigo">Código</label>
                                                </div>
                                                <small for="codigo" id="resultado_error" style="color:red"></small>
                                            </div>

                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="cantidad" min="1" id="cantidad" disabled oninput="totaliza(this)">
                                                    <label for="cantidad">Cantidad</label>
                                                </div>
                                                <small for="codigo" id="cantidad_aviso" style="color:red"></small>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="nombre" id="nombre" disabled>
                                                    <label for="nombre">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="precio_compra" id="precio_compra" disabled>
                                                    <label for="precio_compra">Precio de Compra</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6 mt-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="subtotal" id="subtotal" disabled>
                                                    <label for="subtotal">SubTotal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6 mt-4">
                                                <button type="button" disabled class="btn btn-secondary" id="agregar_producto" name="agregar_producto" onclick="agregarBd(codigo.value, cantidad.value)">Agregar Producto</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Tabla -->
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col" class="moneda">Precio</th>
                                        <th scope="col" class="moneda">Cantidad</th>
                                        <th scope="col" class="moneda">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="tabla_productos" id="tabla_productos">

                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-12 col-sm-6 offset-md-6">
                            <label style="font-weight: bold; font-size: 30px; text-align: center" for="">Total $</label>
                            <input readonly id="total" name="total" value="0.00" size="7" type="text" class="mb-2" style="font-weight: bold; font-size: 30px; text-align:center">
                            <button type="button" name="completa_compra" id="completa_compra" class="btn btn-success mb-3" onclick="guardar()">Completar Compra</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        var aviso = document.getElementById('cantidad_aviso');
        var validar = document.getElementById('cantidad');
        var agregado = document.getElementById('alertok');
        var tabla = document.getElementById('tabla_productos');

        /* Primera Busqueda */
        function buscar(event, tagCodigo, codigo) {

            $enterKey = 13;
            if (codigo != '') {
                if (event.which == $enterKey) {
                    aviso.innerHTML = '';
                    validar.classList.remove('is-invalid');
                    $.ajax({
                        url: '<?php echo base_url() ?>/lstCompras/buscaProducto/' + codigo,
                        dataType: 'json',
                        success: function(resultado) {
                            if (resultado.existe == true && resultado.inventario == true) {
                                $(tagCodigo).removeClass('is-invalid');
                                $(tagCodigo).addClass('is-valid');
                                $("#resultado_error").html('');
                                $("#cantidad").prop('disabled', false);
                                $("#agregar_producto").prop('disabled', false);
                                $("#cantidad").focus();
                                $("#cantidad").val(1);
                                $("#cantidad").attr('max', resultado.productos.existencias);
                                $("#id_producto").val(resultado.productos.id);
                                $("#nombre").val(resultado.productos.nombre);
                                $("#precio_compra").val(resultado.productos.precio_compra);
                                $("#subtotal").val(resultado.productos.precio_compra);
                            } else if (resultado.existe == true && resultado.inventario == false) {
                                $("#resultado_error").html(resultado.error);
                                $(tagCodigo).addClass('is-invalid');
                                $("#cantidad").prop('disabled', true);
                                $("#agregar_producto").prop('disabled', true);
                                $("#cantidad").attr('max', '');
                                $("#nombre").val('');
                                $("#precio_compra").val('');
                                $("#cantidad").val(0);
                                $("#subtotal").val('');
                            } else {
                                $("#resultado_error").html(resultado.error);
                                $(tagCodigo).addClass('is-invalid');
                                $("#cantidad").prop('disabled', true);
                                $("#agregar_producto").prop('disabled', true);
                                $("#cantidad").attr('max', '');
                                $("#nombre").val('');
                                $("#precio_compra").val('');
                                $("#cantidad").val('');
                                $("#subtotal").val('');
                            }
                        }
                    })
                }
            }
        }

        /* Suma de Total */

        function totaliza(tagCodigo) {
            var cantidad = Number(document.getElementById('cantidad').value);
            var precio = document.getElementById('precio_compra').value;
            var sub = document.getElementById('subtotal');
            var total = cantidad * precio;
            var max = Number(tagCodigo.getAttribute('max'))
            sub.value = total.toFixed(2);
            switch (true) {
                case (cantidad == max):
                    aviso.innerHTML = `Solo existen ${max} en inventario`;
                    validar.classList.remove('is-invalid');
                    $("#agregar_producto").prop('disabled', false);
                    $(validar).css('background-color', '#ffffd9');
                    break;
                case (cantidad >= max):
                    aviso.innerHTML = `Solo existen ${max} en inventario`;
                    validar.classList.add('is-invalid');
                    $("#agregar_producto").prop('disabled', true);
                    $("#subtotal").val(0)
                    break;
                case (cantidad <= 0):
                    aviso.innerHTML = "Ingrese una cantidad correcta por favor";
                    validar.classList.add('is-invalid');
                    $("#agregar_producto").prop('disabled', true);
                    $("#subtotal").val(0)
                    break;
                default:
                    aviso.innerHTML = '';
                    validar.classList.remove('is-invalid');
                    $("#agregar_producto").prop('disabled', false);
                    $(validar).removeAttr('style')
            }
        }

        function agregarBd(id_producto, cantidad) {
            $.ajax({
                url: '<?php echo base_url() ?>/lstCompras/agregaProducto/' + id_producto + '/' + cantidad,
                dataType: 'json',
                success: function(resultado) {
                    console.log(resultado);
                    $("#codigo").val('');
                    $("#codigo").removeClass('is-valid');
                    $("#cantidad").val('');
                    $("#nombre").val('');
                    $("#precio_compra").val('');
                    $("#subtotal").val('');
                    tabla.innerHTML = resultado;
                }
            })
        }
    </script>
    <?= $this->endSection(); ?>