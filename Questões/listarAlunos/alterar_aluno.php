<?php

$matricula = "";
$nome = "";
$email = "";
$cpf = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $matricula = $_POST["matricula"];

    $arqAlun = fopen("aluno.txt","r") or die("erro ao abrir arquivo");

    while(!feof($arqAlun)) {

        $linha = fgets($arqAlun);
        $colunaDados = explode(";", $linha);

        if ($colunaDados[2] == $matricula) {
            $nome = $colunaDados[0];
            $email = $colunaDados[1];
            $cpf = $colunaDados[3];
            break;
        }
    }

    fclose($arqAlun);
}

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>Alterar Aluno</h1>

<form action="salvar_alteracao.php" method="POST">

    Nome:
    <input type="text" name="nome" value="<?php echo $nome ?>">

    <br><br>

    Email:
    <input type="text" name="email" value="<?php echo $email ?>">

    <br><br>

    Matricula:
    <input type="text" name="matricula" value="<?php echo $matricula ?>" readonly>

    <br><br>

    CPF:
    <input type="text" name="cpf" value="<?php echo $cpf ?>">

    <br><br>

    <input type="submit" value="Salvar Alteração">

</form>

<br>

</body>
</html>