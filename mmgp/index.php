<?php

$email = $_POST["email"];
$dispositivo = $_POST["dispositivo"];
$operacao = $_POST["operacao"];

function emailCadastrado($mail) {
    $QUERY = "SELECT * FROM usuarios WHERE email = \"" . $mail . "\"";
    $result = mysql_query($QUERY);
    return mysql_num_rows($result) == 1 ? true : false;
}

function regitrarUsuario($mail, $senha) {
    if (emailCadastrado($mail) == false) {
        echo "Usuário não cadastrado!";
    } else {
        echo "Usuário cadastrado";
    }
}

function situacaoAtualMaquinas() {
    
}

function autenticarUsuario() {
}


if ($email != null) {

    if ($dispositivo == "mobile") {
        
        if ($operacao == "atualizarAcoesMaquina") {
            
        } else if ($operacao == "autenticarUsuario") {
            
        } else if ($operacao == "registrarUsuario") {
            
        }

        if (emailCadastrado($email) == false) {
            echo "Não registrado";
        } else {
            echo "Registrado";
        }
    } else if ($dispositivo == "pc") {
        
    }
}


if ($email != null) {

    $conn = mysql_connect("localhost", "mrsoftware", "MRS2012");
    $db = mysql_select_db("mrsoftware");
    $QUERY = "";

    $verificarEmail = $_POST["verificarEmail"] == true ? true : false;

    if ($verificarEmail == true) {
        echo emailCadastrado($email);
        mysql_close($con);
        return;
    }


    $maquina = $_POST["verInformacoesMaquina"];

    if ($maquina != null) {

        $QUERY = "SELECT * FROM maquinas WHERE email = \"" . $email . "\" AND maquina = \"" . $maquina . "\"";
        $result = mysql_query($QUERY);

        if (mysql_num_rows($result) == 0) {
            echo "";
            return;
        }

        $operacoes = mysql_fetch_array($result);

        echo $operacoes ['assinante'] .
        ":" . $operacoes ['bloquear'] .
        ":" . $operacoes ['logoff'] .
        ":" . $operacoes ['hibernar'] .
        ":" . $operacoes ['reiniciar'] .
        ":" . $operacoes ['desligar'] .
        ":" . $operacoes ['keylogger'] .
        ":" . $operacoes ['geolocalizacao'] .
        ":" . $operacoes ['latitude'] .
        ":" . $operacoes ['longitude'];

        mysql_close($con);
        return;
    }

    mysql_close($con);
} else {
    echo "Email não informado.";
}
?>

<body></body>