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

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $sigla = $conn->real_escape_string($_GET["sigla"]);
    $nome = $conn->real_escape_string($_GET["nome"]);
    $carga = $conn->real_escape_string($_GET["carga"]);

    $comandoSQL = "INSERT INTO `disciplina`(`sigla`, `nome`, `carga`) VALUES ('$sigla','$nome','$carga')";
    $resultado = $conn->query($comandoSQL);
}

$retorno = json_encode($resultado);
echo $retorno;

?>  
