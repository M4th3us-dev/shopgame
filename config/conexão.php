<?php
    $hostname = "localhost";
    $bancodedados = "bdsql";
    $usuario = "root";
    $senha = "12345";
    
    $mysql = new mysql ($hostname, $usuario, $senha, $bancodedados);
    if($mysql-> connect_errno){
        echo "falha ao conectar:(" . $mysql->connect_errno . ")" . $mysql-> connect_errno;
    }
        else
            echo "conectando ao Banco de Dados";