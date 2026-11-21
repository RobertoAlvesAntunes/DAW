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
    $IDpergunta = $conn->real_escape_string($_GET["IDpergunta"]);

    if ($acao == "buscar")
    {
        $comandoSQL = "SELECT * FROM `pergunta` WHERE `IDpergunta` = '$IDpergunta'";
        $resultado = $conn->query($comandoSQL);

        if ($resultado->num_rows > 0)
        {
            $linha = $resultado->fetch_assoc();

            $retorno["encontrou"] = "sim";
            $retorno["pergunta"] = $linha["pergunta"];
            $retorno["IDresposta"] = "";
            $retorno["resposta"] = "";

            $comandoSQL = "SELECT * FROM `resposta` WHERE `IDpergunta` = '$IDpergunta'";
            $resultado = $conn->query($comandoSQL);

            while ($linhaResp = $resultado->fetch_assoc())
            {
                $retorno["IDresposta"] = $linhaResp["IDresposta"];
                $retorno["resposta"] = $linhaResp["resposta"];
            }
        }
        else
        {
            $retorno["encontrou"] = "nao";
        }
    }
    else if ($acao == "salvar")
    {
        $novaPergunta = $conn->real_escape_string($_GET["pergunta"]);
        $IDresposta = $conn->real_escape_string($_GET["IDresposta"]);
        $novaResposta = $conn->real_escape_string($_GET["resposta"]);

        $comandoSQL = "UPDATE `pergunta` SET `pergunta` = '$novaPergunta' WHERE `IDpergunta` = '$IDpergunta'";
        $resultado1 = $conn->query($comandoSQL);

        $resultado2 = true;

        if ($IDresposta != "")
        {
            $comandoSQL = "UPDATE `resposta` SET `resposta` = '$novaResposta', `certa` = '1' WHERE `IDresposta` = '$IDresposta'";
            $resultado2 = $conn->query($comandoSQL);
        }

        if ($resultado1 && $resultado2)
        {
            $retorno["msg"] = "Pergunta de texto alterada com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao alterar a pergunta.";
        }
    }
}

echo json_encode($retorno);

?>