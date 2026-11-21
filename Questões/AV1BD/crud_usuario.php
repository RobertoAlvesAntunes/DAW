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

    if ($acao == "incluir")
    {
        $IDusuario = $conn->real_escape_string($_GET["IDusuario"]);
        $nome = $conn->real_escape_string($_GET["nome"]);
        $email = $conn->real_escape_string($_GET["email"]);
        $senhaUsuario = $conn->real_escape_string($_GET["senha"]);

        $comandoSQL = "INSERT INTO `usuario`(`IDusuario`, `nome`, `email`, `senha`) VALUES ('$IDusuario','$nome','$email','$senhaUsuario')";
        $resultado = $conn->query($comandoSQL);

        if ($resultado)
        {
            $retorno["msg"] = "Usuário incluído com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao incluir o usuário.";
        }
    }
    else if ($acao == "buscar")
    {
        $IDusuario = $conn->real_escape_string($_GET["IDusuario"]);

        $comandoSQL = "SELECT * FROM `usuario` WHERE `IDusuario` = '$IDusuario'";
        $resultado = $conn->query($comandoSQL);

        if ($resultado->num_rows > 0)
        {
            $linha = $resultado->fetch_assoc();

            $retorno["encontrou"] = "sim";
            $retorno["IDusuario"] = $linha["IDusuario"];
            $retorno["nome"] = $linha["nome"];
            $retorno["email"] = $linha["email"];
            $retorno["senha"] = $linha["senha"];
        }
        else
        {
            $retorno["encontrou"] = "nao";
        }
    }
    else if ($acao == "salvar")
    {
        $IDusuario = $conn->real_escape_string($_GET["IDusuario"]);
        $novoNome = $conn->real_escape_string($_GET["nome"]);
        $novoEmail = $conn->real_escape_string($_GET["email"]);
        $novaSenha = $conn->real_escape_string($_GET["senha"]);

        $comandoSQL = "UPDATE `usuario` SET `nome` = '$novoNome', `email` = '$novoEmail', `senha` = '$novaSenha' WHERE `IDusuario` = '$IDusuario'";
        $resultado = $conn->query($comandoSQL);

        if ($resultado)
        {
            $retorno["msg"] = "Usuário alterado com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao alterar o usuário.";
        }
    }
    else if ($acao == "excluir")
    {
        $IDusuario = $conn->real_escape_string($_GET["IDusuario"]);

        $comandoSQL = "DELETE FROM `usuario` WHERE `IDusuario` = '$IDusuario'";
        $resultado = $conn->query($comandoSQL);

        if ($resultado)
        {
            $retorno["msg"] = "Usuário excluído com sucesso!!!";
        }
        else
        {
            $retorno["msg"] = "Erro ao excluir o usuário.";
        }
    }
    else if ($acao == "listar")
    {
        $retorno = array();

        $comandoSQL = "SELECT * FROM `usuario`";
        $resultado = $conn->query($comandoSQL);

        while ($linha = $resultado->fetch_assoc())
        {
            $retorno[] = $linha;
        }
    }
}

echo json_encode($retorno);

?>