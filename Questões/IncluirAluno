<?php
    // $msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $matricula = $_POST["matricula"];
    $cpf = $_POST["cpf"];
    $msg = "";
    echo "nome: " . $nome . " email: " . $email . " matricula: " . $matricula . " cpf: " . $cpf;
   if (!file_exists("aluno.txt")) {
       $arqAlun = fopen("aluno.txt","w") or die("erro ao criar arquivo");
       $linha = "nome;email;matricula;cpf\n";
       fwrite($arqAlun,$linha);
       fclose($arqAlun);
   }
   $arqAlun = fopen("aluno.txt","a") or die("erro ao criar arquivo");
 //   $arqAlun = fopen("aluno.txt","w") or die("erro ao criar arquivo");
 //   $linha = "nome;email;matricula;cpf\n";
    $linha = $nome . ";" . $email . ";" . $matricula . ";" . $cpf . "\n";
    fwrite($arqAlun,$linha);
    fclose($arqAlun);
    $msg = "Deu tudo certo!!!";
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Incluir Novo Aluno</h1>
<form action="ex03_IncluirAluno.php" method="POST">
    Nome: <input type="text" name="nome">
    <br><br>
    Email: <input type="text" name="email">
    <br><br>
    Matricula: <input type="text" name="matricula">
    <br><br>
    Cpf: <input type="text" name="cpf">
    <br><br>
    <input type="submit" value="Incluir Novo Aluno">
</form>
<p><?php echo $msg ?></p>
<br>
</body>
</html>
