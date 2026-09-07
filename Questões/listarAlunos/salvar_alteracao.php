<?php

$nome = "";
$email = "";
$matricula = "";
$cpf = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $matricula = $_POST["matricula"];
    $cpf = $_POST["cpf"];

    $arqAlun = fopen("aluno.txt","r") or die("erro ao abrir arquivo");

    $arqAlunNovo = fopen("alunoNovo.txt","w") or die("erro ao criar arquivo");

    $linha = fgets($arqAlun);
    fwrite($arqAlunNovo,$linha);

    while(!feof($arqAlun)) {

        $linha = fgets($arqAlun);
        $colunaDados = explode(";", $linha);

        if ($colunaDados[2] == $matricula) {
            $linha = $nome . ";" . $email . ";" . $matricula . ";" . $cpf . "\n";
        }

        fwrite($arqAlunNovo,$linha);
    }

    fclose($arqAlun);
    fclose($arqAlunNovo);

    $arqAlunNovo = fopen("alunoNovo.txt","r") or die("erro ao abrir arquivo");
    $arqAlun = fopen("aluno.txt","w") or die("erro ao abrir arquivo");

    while(!feof($arqAlunNovo)) {
        $linha = fgets($arqAlunNovo);
        fwrite($arqAlun,$linha);
    }

    fclose($arqAlunNovo);
    fclose($arqAlun);

    $msg = "Aluno alterado com sucesso!!!";
}

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>Alterar Aluno</h1>

<p><?php echo $msg ?></p>

<br>

</body>
</html>