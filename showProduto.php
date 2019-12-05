<?php
    session_start();

    include './includes/header.php';

    include './includes/dbc.php';

    $id = $_GET['id'];

    $query = $dbc->prepare("SELECT
                                nome,
                                descricao,
                                preco,
                                foto
                            FROM produtos
                            WHERE id = :id;");
    
    $query->execute([':id' => $id]);

    $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
    // echo ('<pre>');
    // print_r($produtos);
    // echo ('</pre>');
    // die();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <div class="col-6 mt-5">
                <?php foreach ($produtos as $produto) : ?>
                    <img style = "width: 450px;" src="./assets/img/uploads/<?= $produto['foto']?>" alt="...">
                <?php endforeach; ?>
            </div>
            <div class="col-6 mt-5">
                <?php foreach ($produtos as $produto) : ?>
                    <h3><?= $produto['nome']?></h3>
                        <div>
                            <h5 class="mt-4">Descrição do produto</h5>
                            <div><?= $produto['descricao']?></div>
                        </div>

                        <div>
                            <h5 class="mt-4">Preço</h5>
                            <div><?= $produto['preco']?></div>
                        </div>
                <?php endforeach; ?>
                <div class=" mt-4 d-flex justify-content-around">
                    <form method="POST" action="./includes/deleteProduto.php">
                        <input type="hidden" value="<?= $id ?>" name="id">
                        <input class="btn btn-dark" type="submit" value="Excluir produto">
                    </form>
                    <a href="editProduto.php?id=<?= $id ?>"><button class="btn btn-dark">Editar produto</button></a>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>