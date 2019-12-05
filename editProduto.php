<?php
    session_start();

    include './includes/dbc.php';
    include './includes/header.php';

    $id = $_GET['id'];

    $query = $dbc->prepare("SELECT
                                id,
                                nome,
                                descricao,
                                preco,
                                foto
                            FROM
                                produtos
                            WHERE id = :id;");
    $query->execute([':id' => $id]);
    $produtos = $query->fetchAll(PDO::FETCH_ASSOC)[0];

    if ($_POST) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $foto = $_FILES['foto']['name'];

        $queryEditar = $dbc->prepare("UPDATE
                                        produtos
                                    SET
                                        nome = :nome,
                                        descricao = :descricao,
                                        preco = :preco,
                                        foto = :foto
                                    WHERE id = :id;");
    
        $queryEditar->execute([':id' => $id,
                    ':nome' => $nome,
                    ':descricao' => $descricao,
                    ':preco' => $preco,
                    ':foto' => $foto]);

        header('Location:indexProduto.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h5 class="mb-4 text-center">Inserir um produto</h5>
        <form method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="nome">Nome do produto</label>
                <input name="nome" class="form-control" type="text" value="<?= $produtos['nome'] ?>">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição do produto</label>
                <input name="descricao" class="form-control" value="<?=$produtos['descricao']?>"></input>
            </div>

            <div class="form-group">
                <label for="preco">Preço do produto</label>
                <input name="preco" class="form-control" type="number" step="0.01" min="0" value="<?=$produtos['preco']?>">
            </div>

            <label>Foto do produto</label>
            <div class="custom-file">
                <input name="foto" type="file" class="custom-file-input">
                <label class="custom-file-label" for="foto">Selecione a imagem</label>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">

            <input type="submit" class="btn btn-dark mt-4 mb-4" value="Atualizar produto">
        </form>
    </div>
</body>
</html>