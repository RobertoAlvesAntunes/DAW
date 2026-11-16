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
    $matricula = $_GET["matricula"];
    $nome = $_GET["nome"];
    $email = $_GET["email"];
    $comandoSQL = "UPDATE FROM Alunos SET nome = '$nome', email = '$email' WHERE matricula = '$matricula'";
    $resultado = $conn->query($comandoSQL);

}
$retorno = json_encode($resultado);
echo $retorno;

?>  
