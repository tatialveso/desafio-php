<?php
    function checarNome($str) {

        // verificando se a string tem um mínimo de caracteres
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
    