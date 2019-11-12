<?php

    include('./includes/validacoes.php');
    include('./includes/header.php');

    $nomeCorreto = true;
    $precoCorreto = true;
    $fotoCorreta = true;

    if ($_POST) {
        $nomeCorreto = checarNome($_POST['nome']);

        $nome = $_POST['nome'];

        $precoCorreto = checarPreco($_POST['preco']);

        $preco = $_POST['preco'];

        $fotoCorreta = checarFoto($_FILES['foto']['name']);

        $foto = $_FILES['foto']['name'];

        if ($_FILES['foto']['error'] == 0) {
            $caminhoTmp = $_FILES['foto']['tmp_name'];

            move_uploaded_file($caminhoTmp, './img/uploads/' . $foto);
        }

        $produtosJson = file_get_contents('./basedados/produtos.json');

        $arrayProdutos = json_decode($produtosJson, true);

        $novoProduto = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'preco' => $_POST['preco'],
            'foto' => $foto
        ];

        $arrayProdutos[] = $novoProduto;

        $novoProdutosJson = json_encode($arrayProdutos);

        file_put_contents('./basedados/produtos.json', $novoProdutosJson);

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio PHP: Inserir Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h5 class="mb-4 text-center">Inserir um produto</h5>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do produto</label>
                <input name="nome"
                class="form-control <?php if(!$nomeCorreto) { echo ('is-invalid');} ?>" type="text" placeholder="Insira o nome">
                <?php if (!$nomeCorreto) : ?>
                    <div class="invalid-feedback">
                        O nome precisa ter no mínimo três caracteres.
                    </div>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição do produto</label>
                <textarea name="descricao" class="form-control" rows="3" placeholder="Descreva o produto"></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço do produto</label>
                <input name="preco" class="form-control <?php if(!$precoCorreto) { echo ('is-invalid');} ?>" type="number" step="0.01" min="0" placeholder="Insira o preço">
                <?php if (!$precoCorreto) : ?>
                    <div class="invalid-feedback">
                        O preço precisar ser um valor numérico.
                    </div>
                <?php endif ?>
            </div>
            <label>Foto do produto</label>
            <div class="custom-file">
                <input name="foto" type="file" class="custom-file-input <?php if(!$fotoCorreta) { echo ('is-invalid');} ?>" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="foto">Selecione a imagem</label>
                <?php if (!$fotoCorreta) : ?>
                    <div class="invalid-feedback">
                        A foto é obrigatória.
                    </div>
                <?php endif ?>
            </div>
            <button type="submit" class="btn btn-primary mt-4 mb-4">Submeter</button>
        </form>
    </div>
</body>
</html>