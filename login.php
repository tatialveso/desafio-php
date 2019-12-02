<?php
    session_start();

    include 'includes/header.php';
    include 'includes/dbc.php';

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

                $_SESSION['acesso'] = $acesso;

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
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h5 class="mb-4 text-center mt-4">Login</h5>
        <?php if (isset($erroLogin)) : ?>
            <div class="alert alert-danger"><?= $erroLogin ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">Endereço de e-mail</label>
                <input style="width:500px;" name="emailLogin" type="email" class="form-control" placeholder="Insira seu e-mail">
                <?php if (isset($_COOKIE['emailUsuario'])) {
                    echo "value='$_COOKIE[emailUsuario]'";
                } ?>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input name="senhaLogin" type="password" class="form-control" placeholder="Insira a senha">
                <?php if (isset($_COOKIE['senhaUsuario'])) {
                    echo "value='$_COOKIE[senhaUsuario]'";
                } ?>
            </div>
            <div class="form-group">
                <input type="checkbox" name="manter" id="manter">
                <label for="manter">Manter conectado</label>
            </div>
            <button type="submit" class="btn btn-dark col-12 mt-3">Entrar</button>
        </form>
    </div>
</body>
</html>