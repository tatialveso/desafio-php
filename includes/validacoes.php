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

    function checarEmail($str) {
        if (!$str) {
            return false;
        } else {
            return true;
        } 
    }

    function checarSenha($str) {
        if (strlen($str) < 6) {
            return false;
        } else {
            return true;
        }
    }