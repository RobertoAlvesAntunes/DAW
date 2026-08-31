<?php
    $sigla = "";
    $msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET')  {
    $sigla = $_GET["sigla"];
    $msg = "";

    $arqDisc = fopen("disciplinas.txt","r") or die("erro ao abrir arquivo");
    $arqDiscNovo = fopen("disciplinasNovo.txt","w") or die("erro ao criar arquivo");

    $linha = fgets($arqDisc);
    fwrite($arqDiscNovo,$linha);

    while(!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        $colunaDados = explode(";", $linha);

        if ($colunaDados[1] != $sigla) {
            fwrite($arqDiscNovo,$linha);
        }
    }

    fclose($arqDisc);
    fclose($arqDiscNovo);

    $msg = "Deu tudo certo!!!";
}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>Excluir Disciplina</h1>

<p><?php echo $msg ?></p>

<br>

</body>
</html>

