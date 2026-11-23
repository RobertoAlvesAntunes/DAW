<?php
$servidor = "localhost";   
$username = "root";
$senha = "";
$database = "faeterj3dawmanha";
$conn = new mysqli($servidor,$username,$senha,$database);
if ($conn->connect_error) {
    die("Conexao falhou, avise o administrador do sistema");
}
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sigla = $_GET["sigla"];
    $nome = $_GET["nome"];
    $carga = $_GET["carga"];
    $comandoSQL = "INSERT INTO `disciplina`(`sigla`, `nome`, `carga`) VALUES ('$sigla','$nome','$carga')";
    $resultado = $conn->query($comandoSQL);

}

$retorno = json_encode($resultado);
echo $retorno;

?>  
