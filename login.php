<?php
    session_start();

    include './includes/dbc.php';

    $emailLoginCerto = true;
    $senhaLoginCerta = true;

    if ($_POST) {
        $query = $dbc->prepare("SELECT
                                    email,
                                    senha
                                FROM
                                    usuarios;");
        $query->execute();
        $acessos = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($acessos as $acesso) {
            if ($_POST['emailLogin'] == $acesso['email'] && password_verify($_POST['senhaLogin'], $acesso['senha'])) {
                
                if ($_POST['manter'] == "on") {
                    setcookie('emailUsuario', $_POST['emailLogin']);
                    setcookie('senhaUsuario', $_POST['senhaLogin']);
                }

                $acesso = $_SESSION['acesso'];

                return header('location: createUsuario.php');
            }
        }

        $erroLogin = 'E-mail e/ou senha não encontrados';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand text-light"><h2>Desafio PHP</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h5 class="mb-4 text-center mt-4">Login</h5>
        <?php if (isset($erroLogin)) : ?>
            <div class="alert alert-danger"><?= $erroLogin ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">Endereço de e-mail</label>
                <input style="width:500px;" name="emailLogin" type="email" class="form-control" placeholder="Insira seu e-mail" <?php if (isset($_COOKIE['emailUsuario'])) { echo "value='$_COOKIE[emailUsuario]'"; } ?>>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input name="senhaLogin" type="password" class="form-control" placeholder="Insira a senha" <?php if (isset($_COOKIE['senhaUsuario'])) { echo "value='$_COOKIE[senhaUsuario]'"; } ?>>
            </div>
            <div class="form-group">
                <input type="checkbox" name="manter" id="manter">
                <label for="manter">Manter conectado</label>
            </div>
            <button type="submit" class="btn btn-dark col-12 mt-3">Entrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>