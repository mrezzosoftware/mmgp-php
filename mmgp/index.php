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

/**
 *
 * Funcionalidades utilizadas pelo programa do PC
 *  
 */
function regitrarUsuario($email, $senha) {
    if (emailCadastrado($email) == false) {
        $INSERT = "INSERT INTO usuarios VALUES ('" . $email . "', '" . $senha . "')";
        mysql_query($INSERT);
        echo (mysql_affected_rows() == 1) ? "CAD-USU-SUC" : "ERRO: " . apresentarErroMySql();
    } else {
        echo "JA-CAD";
    }
}

function autenticarUsuario($email, $senha) {
    $QUERY = "SELECT COUNT(*) AS registrado FROM usuarios WHERE email = '" . $email . "' AND senha = '" . $senha . "'";
    $result = mysql_query($QUERY);
    $resposta = mysql_fetch_array($result);

    echo $resposta['registrado'] == 1 ? "AUTH" : "NAUTH";
}

function obterMaquinasUsuario($email) {
    $QUERY = "SELECT maquina FROM maquinas WHERE email = '" . $email . "'";
    $result = mysql_query($QUERY);
    $maquinas = "";
    while ($linha = mysql_fetch_array($result)) {
        $maquinas .= ($linha['maquina'] . ":");
    }
    $maquinas = substr($maquinas, 0, -1);
    echo $maquinas;
}

function atualizarAcoesMaquina($email, $maquina, $dados) {

    list($tempoAtualizacao, $acao, $keylogger, $geolocalizacao) = explode(":", $dados);

    $UPDATE = "
        UPDATE maquinas
        SET tempo_atualizacao = '" . $tempoAtualizacao . "',
            ultima_atualizacao = '" . date("Y-m-d H:i:s") . "',
            acao = '" . $acao . "',
            keylogger = '" . $keylogger . "',
            geolocalizacao = '" . $geolocalizacao . "'
        WHERE email = '" . $email . "' AND maquina = '" . $maquina . "'";
    echo "UPDATE: " . $UPDATE;
    mysql_query($UPDATE);
    echo (mysql_affected_rows() == 1) ? "ATU-ACOES-MAQ-SUC" : "ERRO: " . apresentarErroMySql();
}

function obterAcoesMaquina($email, $maquina) {

    $QUERY = "SELECT * FROM maquinas WHERE email = \"" . $email . "\" AND maquina = \"" . $maquina . "\"";
    $result = mysql_query($QUERY);

    if (mysql_num_rows($result) == 0) {
        echo "";
        return;
    }

    $operacoes = mysql_fetch_array($result);

    echo $operacoes ['ligada'] .
    ":" . $operacoes ['tempo_atualizacao'] .
    ":" . $operacoes ['ultima_atualizacao'] .
    ":" . $operacoes ['acao'] .
    ":" . $operacoes ['keylogger'] .
    ":" . $operacoes ['geolocalizacao'] .
    ":" . $operacoes ['latitude'] .
    ":" . $operacoes ['longitude'];
}

/**
 *
 * Funcionalidades utilizadas pelo programa do PC
 *  
 */
function maquinaCadastrada($email, $maquina) {

    $QUERY = "SELECT * FROM maquinas WHERE email = '" . $email . "' AND maquina = '" . $maquina . "'";
    $result = mysql_query($QUERY);
    return mysql_num_rows($result) == 1 ? true : false;
}

function cadastrarMaquina($email, $maquina) {

    if (emailCadastrado($email) == true) {
        if (maquinaCadastrada($email, $maquina) == false) {
            $INSERT = "INSERT INTO maquinas (email, maquina) VALUES ('" . $email . "', '" . $maquina . "')";
            mysql_query($INSERT);
            echo (mysql_affected_rows() == 1) ? "CAD-MAQ-SUC" : "ERRO: " . apresentarErroMySql();
        } else {
            echo "MAQ-JA-CAD";
        }
    } else {
        echo "MAIL-NAO-CAD";
    }
}

function atualizarSituacaoMaquina($email, $maquina, $situacao) {

    $UPDATE = "UPDATE maquinas SET ligada = " . $situacao . ", ultima_atualizacao= '" . date("Y-m-d H:i:s") . "' WHERE email = '" . $email . "' AND maquina = '" . $maquina . "'";
    $result = mysql_query($UPDATE);
    echo (mysql_affected_rows() == 1) ? "ATU-SIT-MAQ-SUC" : "ERRO: " . apresentarErroMySql();
}

if ($email != null) {
    if ($dispositivo == "mobile") {

        if ($operacao == "atualizarAcoesMaquina") {

            $maquina = $_POST["maquina"];
            $dados = $_POST["dados"];
            atualizarAcoesMaquina($email, $maquina, $dados);
        } else if ($operacao == "autenticarUsuario") {

            $senha = $_POST["pwd"];
            autenticarUsuario($email, $senha);
        } else if ($operacao == "obterMaquinasUsuario") {

            obterMaquinasUsuario($email);
        } else if ($operacao == "obterAcoesMaquina") {

            $maquina = $_POST["maquina"];
            obterAcoesMaquina($email, $maquina);
        } else if ($operacao == "registrarUsuario") {

            $senha = $_POST["pwd"];
            regitrarUsuario($email, $senha);
        } else if ($operacao == "tst") {
            echo date("Y-m-d H:i:s") . " timestamp";
        }
    } else if ($dispositivo == "pc") {
        if ($operacao == "obterAcoesMaquina") {

            $maquina = $_POST["maquina"];
            obterAcoesMaquina($email, $maquina);
            atualizarSituacaoMaquina($email, $maquina, 1);
        } else if ($operacao == "atualizarSituacaoMaquina") {

            $maquina = $_POST["maquina"];
            $situacao = $_POST["situacao"];
            atualizarSituacaoMaquina($email, $maquina, $situacao);
        } else if ($operacao == "cadastrarMaquina") {

            $maquina = $_POST["maquina"];
            cadastrarMaquina($email, $maquina);
        }
    }

    mysql_close();
}
?>

<body></body>