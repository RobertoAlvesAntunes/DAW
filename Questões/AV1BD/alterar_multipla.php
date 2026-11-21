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
            $retorno["IDpergunta"] = $linha["IDpergunta"];
            $retorno["pergunta"] = $linha["pergunta"];

            $comandoSQL = "SELECT * FROM `resposta` WHERE `IDpergunta` = '$IDpergunta' LIMIT 4";
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
    else if ($acao == "salvar")
    {
        $novaPergunta = $conn->real_escape_string($_GET["pergunta"]);
        $ok = true;

        $comandoSQL = "UPDATE `pergunta` SET `pergunta` = '$novaPergunta' WHERE `IDpergunta` = '$IDpergunta'";
        $resultado = $conn->query($comandoSQL);

        if (!$resultado)
        {
            $ok = false;
        }

        for ($i = 1; $i <= 4; $i++)
        {
            $IDresposta = $conn->real_escape_string($_GET["IDresposta" . $i]);
            $resposta = $conn->real_escape_string($_GET["resposta" . $i]);
            $certa = $conn->real_escape_string($_GET["certa" . $i]);

            if ($IDresposta != "")
            {
                $comandoSQL = "UPDATE `resposta` SET `resposta` = '$resposta', `certa` = '$certa' WHERE `IDresposta` = '$IDresposta'";
                $resultado = $conn->query($comandoSQL);

                if (!$resultado)
                {
                    $ok = false;
                }
            }
        }

        if ($ok)
        {
            $retorno["msg"] = "Pergunta e respostas alteradas com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao alterar a pergunta.";
        }
    }
}

echo json_encode($retorno);

?>