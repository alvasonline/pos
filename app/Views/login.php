<?php $user_session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $titulo ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://startbootstrap.github.io/startbootstrap-sb-admin/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d27d39ec85.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body class="bg-dark">
<?php if($user_session->nombre !=null):
    return redirect()->to(base_url('/configuracion'));
endif
?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= $titulo ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?= base_url() ?>/Front/validarlogin">
                                        <div class="form-floating mb-3">
                                            <input value="<?= old('usuario') ?>" name="usuario" class="form-control" id="inputEmail" type="text" />
                                            <label for="inputEmail">Usuario</label>
                                            <small class="text-danger"> <?= session('errors.usuario') ?></small>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input value="<?= old('password') ?>" name="password" class="form-control" id="inputPassword" type="password" />
                                            <label for="inputPassword">Contraseña</label>
                                            <small class="text-danger"> <?= session('errors.password') ?></small>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label small" for="inputRememberPassword">Recordar Contraseña</label>
                                        </div>
                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $error ?>
                                            </div>
                                        <?php } ?>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button class="btn btn-success" type="submit">Login</button>
                                        </div>
                                    </form>
                                    <?php echo $user_session->nombre ?>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a class="link-secondary" href="register.html">No tienes Cuenta? Consíguela aquí!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; AlvasOnline <?php echo date('Y'); ?></div>
                    <div>
                        <i class="fa-brands fa-facebook"></i> <a style="color:#666; text-decoration:none" href="#"> Facebook</a>
                        &middot;
                        <i class="fa-brands fa-instagram-square"></i> <a style="color:#666; text-decoration:none" href="#"> Instagram</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://startbootstrap.github.io/startbootstrap-sb-admin/js/scripts.js"></script>
</body>

</html>