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

<h1>Excluir Aluno</h1>

<p>Nome: <?php echo $nome ?></p>
<p>Email: <?php echo $email ?></p>
<p>Matricula: <?php echo $matricula ?></p>
<p>CPF: <?php echo $cpf ?></p>

<p>Deseja realmente excluir este aluno?</p>

<form action="confirmar_exclusao.php" method="POST">

    <input type="hidden" name="matricula" value="<?php echo $matricula ?>">

    <input type="submit" value="Confirmar Exclusão">

</form>

<br>

<form action="listar_alunos.php" method="POST">

    <input type="submit" value="Cancelar">

</form>

<br>

</body>
</html>