<?php
$email = $_POST["email"];
$dispositivo = $_POST["dispositivo"];
$operacao = $_POST["operacao"];

$conn = mysql_connect("localhost", "mrsoftware", "MRS2012");
$db = mysql_select_db("mrsoftware");

function emailCadastrado($email) {
    $QUERY = "SELECT * FROM usuarios WHERE email = '" . $email . "'";
    $result = mysql_query($QUERY);
    return mysql_num_rows($result) == 1 ? true : false;
}

function regitrarUsuario($email, $senha) {
    if (emailCadastrado($email) == false) {
        //$INSERT = "INSERT INTO usuarios VALUES ('" . $mail . "', '" . $senha . "')";
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
            
        } else if ($operacao == "obterAcoesMaquina") {

            $maquina = $_POST["maquina"];
            
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
        } else if ($operacao == "autenticarUsuario") {
            
        } else if ($operacao == "registrar_usuario") {
            $senha = $_POST["pwd"];
            regitrarUsuario($email, $senha);
        }
        
    } else if ($dispositivo == "pc") {
        
    }

    mysql_close();
}
?>

<body></body>