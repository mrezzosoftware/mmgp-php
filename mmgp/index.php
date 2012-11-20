<?php
$email = $_POST["email"];
$dispositivo = $_POST["dispositivo"];
$operacao = $_POST["operacao"];

$conexao = mysql_connect("localhost", "mrsoftware", "MRS2012");
if (!$conexao) {
    echo "ERRO-CONEXAO<br/>";
    echo mysql_errno() . "<br/>";
    echo mysql_error() . "<br/>";
    exit();
}

$db = mysql_select_db("mrsoftware");

function apresentarErroMySql() {
    return mysql_errno() . " - " . mysql_error();
}

function emailCadastrado($email) {
    $QUERY = "SELECT * FROM usuarios WHERE email = '" . $email . "'";
    $result = mysql_query($QUERY);
    return mysql_num_rows($result) == 1 ? true : false;
}

function regitrarUsuario($email, $senha) {
    if (emailCadastrado($email) == false) {
        $INSERT = "INSERT INTO usuarios VALUES ('" . $email . "', '" . $senha . "')";
        $result = mysql_query($INSERT);
        echo (mysql_affected_rows() == 1) ? "CAD-SUC" : "ERRO: " . apresentarErroMySql();
    } else {
        echo "JA-CAD";
    }
}

function obterMaquinasUsuario($email) {
    
}

function atualizarAcoesMaquinas($email, $maquina, $dados) {

    list($bloquear, $logoff, $hibernar, $reiniciar, $desligar, $keylogger, $geolocalizacao, $latitude, $longitude) = explode(":", $dados);

    $UPDATE = "
        UPDATE maquinas
        SET bloquear = '" . $bloquear . "',
            logoff = '" . $logoff . "',
            hibernar = '" . $hibernar . "',
            reiniciar = '" . $reiniciar . "',
            desligar = '" . $desligar . "',
            keylogger = '" . $keylogger . "',
            geolocalizacao = '" . $geolocalizacao . "'
        WHERE email = '" . $email . "' AND maquina = '" . $maquina . "'";
    echo $UPDATE . "<br/>";
    $result = mysql_query($UPDATE);
    echo (mysql_affected_rows() == 1) ? "ATU-ACOES-MAQ-SUC" : "ERRO: " . apresentarErroMySql();
}

function autenticarUsuario($email, $senha) {
    $QUERY = "SELECT COUNT(*) AS registrado FROM usuarios WHERE email = '" . $email . "' AND senha = '" . $senha . "'";
    $result = mysql_query($QUERY);
    $resposta = mysql_fetch_array($result);

    echo $resposta['registrado'] == 1 ? "AUTH" : "NAUTH";
}

function obterAcoesMaquina($email, $maquina) {

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
}

if ($email != null) {
    if ($dispositivo == "mobile") {

        if ($operacao == "atualizarAcoesMaquina") {

            $maquina = $_POST["maquina"];
            $dados = $_POST["dados"];
            atualizarAcoesMaquinas($email, $maquina, $dados);
            
        } else if ($operacao == "obterAcoesMaquina") {

            $maquina = $_POST["maquina"];
            obterAcoesMaquina($email, $maquina);
        } else if ($operacao == "autenticarUsuario") {

            $senha = $_POST["pwd"];
            autenticarUsuario($email, $senha);
        } else if ($operacao == "registrarUsuario") {

            $senha = $_POST["pwd"];
            regitrarUsuario($email, $senha);
        }
    } else if ($dispositivo == "pc") {
        
    }

    mysql_close();
}
?>

<body></body>