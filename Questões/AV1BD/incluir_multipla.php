<?php

$servidor = "localhost";
$username = "root";
$senha = "";
$database = "faeterj3dawmanha";

$conn = new mysqli($servidor, $username, $senha, $database);

if ($conn->connect_error)
{
    die("Conexao falhou, avise o administrador do sistema");
}

$retorno = array();

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $acao = $_GET["acao"];

    if ($acao == "incluirPergunta")
    {
        $IDpergunta = $conn->real_escape_string($_GET["IDpergunta"]);
        $pergunta = $conn->real_escape_string($_GET["pergunta"]);

        $comandoSQL = "INSERT INTO `pergunta`(`IDpergunta`, `pergunta`) VALUES ('$IDpergunta','$pergunta')";
        $resultado = $conn->query($comandoSQL);

        if ($resultado)
        {
            $retorno["msg"] = "Pergunta incluída com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao incluir a pergunta.";
        }
    }
    else if ($acao == "incluirResposta")
    {
        $IDresposta = $conn->real_escape_string($_GET["IDresposta"]);
        $IDpergunta = $conn->real_escape_string($_GET["IDpergunta"]);
        $resposta = $conn->real_escape_string($_GET["resposta"]);
        $certa = $conn->real_escape_string($_GET["certa"]);

        $comandoSQL = "INSERT INTO `resposta`(`IDresposta`, `IDpergunta`, `resposta`, `certa`) VALUES ('$IDresposta','$IDpergunta','$resposta','$certa')";
        $resultado = $conn->query($comandoSQL);

        if ($resultado)
        {
            $retorno["msg"] = "Resposta incluída com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao incluir a resposta.";
        }
    }
}

echo json_encode($retorno);

?>