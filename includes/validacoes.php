<?php
    function checarNome($str) {
        if (strlen($str) < 3) {
            return false;
        }
            return true;
    
    }

    function checarPreco($str) {
        if (is_numeric($str)) {
            return true;
        } else {
            return false;
        }
    }

    function checarFoto($str) {
        if (!$str) {
            return false;
        } else {
            return true;
        }
    }

    function pegarProdutos() {
        $produtosJson = file_get_contents('basedados/produtos.json');

        $arrayProdutos = json_decode($produtosJson, true);
    }