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
    $IDpergunta = $conn->real_escape_string($_GET["IDpergunta"]);

    $comandoSQL = "DELETE FROM `resposta` WHERE `IDpergunta` = '$IDpergunta'";
    $resultado1 = $conn->query($comandoSQL);

    $comandoSQL = "DELETE FROM `pergunta` WHERE `IDpergunta` = '$IDpergunta'";
    $resultado2 = $conn->query($comandoSQL);

    if ($resultado1 && $resultado2)
    {
        $retorno["msg"] = "Pergunta e respostas excluídas com sucesso!!!";
    }
    else
    {
        $retorno["msg"] = "Erro ao excluir a pergunta.";
    }
}

echo json_encode($retorno);

?>