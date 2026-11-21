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

    $comandoSQL = "SELECT * FROM `pergunta` WHERE `IDpergunta` = '$IDpergunta'";
    $resultado = $conn->query($comandoSQL);

    if ($resultado->num_rows > 0)
    {
        $linha = $resultado->fetch_assoc();

        $retorno["encontrou"] = "sim";
        $retorno["IDpergunta"] = $linha["IDpergunta"];
        $retorno["pergunta"] = $linha["pergunta"];

        $comandoSQL = "SELECT * FROM `resposta` WHERE `IDpergunta` = '$IDpergunta'";
        $resultado = $conn->query($comandoSQL);

        $respostas = array();

        while ($linhaResp = $resultado->fetch_assoc())
        {
            $respostas[] = $linhaResp;
        }

        $retorno["respostas"] = $respostas;
    }
    else
    {
        $retorno["encontrou"] = "nao";
    }
}

echo json_encode($retorno);

?>