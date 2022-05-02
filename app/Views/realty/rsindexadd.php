<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body class="mb-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-dark bg-warning">
                        <h4>Nuevo articulo</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST"  action="<?= base_url() ?>/Realty/guardar">
                            <div class="form-floating mb-3">
                                <input required type="text" value="<?=old('titulo')?>" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                                <label for="titulo">Titulo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea required class="form-control" value="<?=old('detalles')?>" placeholder="Detalles del articulo" name="detalles" id="detalles" style="height: 100px"></textarea>
                                <label for="detalles">Detalles</label>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input required type="number" value="<?=old('precio')?>" class="form-control" name="precio" id="precio" placeholder="Precio">
                                        <label for="precio">Precio</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input required type="number" value="<?=old('cuartos')?>" class="form-control" name="cuartos" id="cuartos" placeholder="cuartos">
                                        <label for="cuartos">Cuartos</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <select class="form-select" id="rango" name="rango" aria-label="selecciona rango salarial">
                                            <option selected>Rango salarial</option>
                                            <option value="$1,000 / $2,000">$1,000 / $2,000</option>
                                            <option value="$2.500 / $3,000">$2.500 / $3,000</option>
                                            <option value="$3,500 / $4,000">$3,500 / $4,000</option>
                                        </select>
                                        <label for="rango">Rango</label>
                                    </div>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-warning">Guardar</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="fs-6 text-center">Design by Alvasonline</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    
</script>
</body>

</html>