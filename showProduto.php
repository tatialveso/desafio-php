<?php

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
                    <img src="./assets/img/uploads/<?= $produto['foto']?>.png" alt="...">
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
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <form method="POST" action="./includes/deleteProduto.php">
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <input class="btn btn-dark" type="submit" value="Excluir produto">
                </form>
            </div>
            <div class="col-6">
                <a href="editProduto.php?id=<?= $id ?>"><button class="btn btn-dark">Editar produto</button></a>
            </div>
        </div>
    </main>
</body>
</html>